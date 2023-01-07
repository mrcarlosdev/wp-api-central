<div class="wrap">
<script>
    function copyToClipboard(widgetcode) {
        // Get the text field
        var copyText = document.getElementById(widgetcode);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        document.getElementById(widgetcode + 'info').innerHTML = '<button type="button" class="btn btn-success btn-sm">Copied!</button>';
    }
</script>
<h1 class='wp-heading-inline'>WP API Central > Widgets</h1>
<?php
    function get_content($URL){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $URL);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }

    function displayText($text) {
        if (is_null($text)) {
            $text = '';
        }

        return $text;
    }

    function displaySubscriptionRequired($subscription) {
        if (is_null($subscription)) {
            $subscription = 1;
        }

        if ($subscription == 1) {
            $subscription = '<button type="button" class="btn btn-danger btn-sm">Required</button>';
        } else {
            $subscription = '<button type="button" class="btn btn-primary btn-sm">Not Required</button>';
        }

        return $subscription;
    }

        // Get credentials from Database
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}azure_config limit 1;";
        $config_apim = $wpdb->get_results($query,ARRAY_A);
        if(!empty($config_apim[0]) && $config_apim[0]['accessToken'] != '' && $config_apim[0]['subscriptionId'] != '' && $config_apim[0]['resourceGroup'] != '' && $config_apim[0]['serviceId'] != '') {
                $urlAPIs = 'https://'.$config_apim[0]["serviceId"].'.management.azure-api.net/subscriptions/'.$config_apim[0]["subscriptionId"].'/resourceGroups/'.$config_apim[0]["resourceGroup"].'/providers/Microsoft.ApiManagement/service/'.$config_apim[0]["serviceId"].'/apis?api-version=2021-08-01';
                $urlProducts = 'https://'.$config_apim[0]["serviceId"].'.management.azure-api.net/subscriptions/'.$config_apim[0]["subscriptionId"].'/resourceGroups/'.$config_apim[0]["resourceGroup"].'/providers/Microsoft.ApiManagement/service/'.$config_apim[0]["serviceId"].'/products?api-version=2021-08-01';
        }
?>
<p>Here you can see how your widgets are going to be displayed in your website. Get the shortcode for the desired one and paste it wherever you want. Your widgets are ready to be used. </p>
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Widget: Display APIs</h5>
        
    <?php
    $apis = get_content($urlAPIs);
    if (isset($apis['value'])) {
        ?>
        <p class="card-text">
                <table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Subscription</th>
    </tr>
  </thead>
  <tbody>
        <?php
    foreach ($apis['value'] as $key => $value) {
            ?>
        <tr>
        <td><?php echo displayText($value['properties']['displayName']); ?></td>
        <td><?php echo displayText($value['properties']['description']); ?></td>
        <td><?php echo displaySubscriptionRequired($value['properties']['subscriptionRequired']); ?></td>
        </tr>
    <?php
    } 
    ?>
  </tbody>
</table>
 </p>
        <input type="text" value="[APIM display='apis']" id="wapis">

        <button onclick="copyToClipboard('wapis')" class="btn btn-primary">Copy shortcode!</button>
                <div id=wapisinfo></div>
    <?php
    } else {
?>
<h5 style="color:red;">We were unable to retrieve the data. Please check the connection parameters.</h5>
<?php
    }
    ?>


       
                </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Widget: Display Products</h5>
        <p class="card-text">
            <?php $products = get_content($urlProducts);  ?>
                <?php
                if (isset($products['value'])) { ?>
                            <table class="table">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Subscription</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        foreach ($products['value'] as $key => $value) {
                ?>
                    <tr>
                    <td><?php echo displayText($value['properties']['displayName']); ?></td>
                    <td><?php echo displayText($value['properties']['description']); ?></td>
                    <td><?php echo displaySubscriptionRequired($value['properties']['subscriptionRequired']); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            </table>

        </p>
                <input type="text" value="[APIM display='products']" id="wproducts">

        <button onclick="copyToClipboard('wproducts')" class="btn btn-primary">Copy shortcode!</button>
        <div id=wproductsinfo></div>
                <?php
                } else {
                   ?>
                <h5 style="color:red;">We were unable to retrieve the data. Please check the connection parameters.</h5>
                <?php     
                }
                ?>

      </div>
    </div>
  </div>
</div>
</div>
