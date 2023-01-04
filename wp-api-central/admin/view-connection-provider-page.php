<div class="wrap">
        <h2 class='wp-heading-inline'>Azure API Management</h2>
        <?php
                global $wpdb;

                if(isset($_POST)) {
                        // Access Token
                        if (isset($_POST['txtaccesstoken'])) {
                                $table = $wpdb->prefix."azure_config";
                                $wpdb->query(
                                $wpdb->prepare("UPDATE $table SET `accessToken` = %s", $_POST['txtaccesstoken']));
                        }

                        // Subscription Id
                        if (isset($_POST['txtsubscriptionid'])) {
                                $table = $wpdb->prefix."azure_config";
                                $wpdb->query(
                                $wpdb->prepare("UPDATE $table SET `subscriptionId` = %s", $_POST['txtsubscriptionid']));
                        }

                        // Resource Group
                        if (isset($_POST['txtresourcegroup'])) {
                                $table = $wpdb->prefix."azure_config";
                                $wpdb->query(
                                $wpdb->prepare("UPDATE $table SET `resourceGroup` = %s", $_POST['txtresourcegroup']));
                        }

                        // Service Id
                        if (isset($_POST['txtserviceid'])) {
                                $table = $wpdb->prefix."azure_config";
                                $wpdb->query(
                                $wpdb->prepare("UPDATE $table SET `serviceId` = %s", $_POST['txtserviceid']));
                        }
                }

                $query = "SELECT * FROM {$wpdb->prefix}azure_config limit 1;";
                $config_apim = $wpdb->get_results($query,ARRAY_A);
                if(empty($config_apim)) {
                        $config_apim = array();
                }
        ?>
        <br /><br /><br />
        <table class="wp-list-table widefat fixed striped pages">
        <thead>
                <th>Configuration field</th>
                <th>Value</th>
                <th>Actions</th>
        </thead>
        <tbody id="the-list">
                <tr>
                        <td>Access Token</td>
                        <td><?php echo $config_apim[0]['accessToken'];?></td>
                        <td>
                                <a id="setAccessToken" class="page-title-action">Set new value</a>
                                <a data-id="accesstoken" id="deleteAccessToken" class="page-title-action">Delete</a>
                        </td>
                </tr>
                <tr>
                        <td>Subscription Id</td>
                        <td><?php echo $config_apim[0]['subscriptionId'];?></td>
                        <td>
                                <a id="setSubscriptionId" class="page-title-action">Set new value</a>
                                <a data-id="subscriptionid" id="deleteSubscriptionId" class="page-title-action">Delete</a>
                        </td>
                </tr>
                <tr>
                        <td>Resource Group</td>
                        <td><?php echo $config_apim[0]['resourceGroup'];?></td>
                        <td>
                                <a id="setResourceGroup" class="page-title-action">Set new value</a>
                                <a data-id="resourcegroup" id="deleteResourceGroup" class="page-title-action">Delete</a>
                        </td>
                </tr>
                <tr>
                        <td>Service Name</td>
                        <td><?php echo $config_apim[0]['serviceId'];?></td>
                        <td>
                                <a id="setServiceId" class="page-title-action">Set new value</a>
                                <a data-id="serviceid" id="deleteServiceId" class="page-title-action">Delete</a>
                        </td>
                </tr>
        </tbody>
        </table>
        <br /><br />
</div>

<?php

        // Get credentials from Database
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}azure_config limit 1;";
        $config_apim = $wpdb->get_results($query,ARRAY_A);
        if(!empty($config_apim[0]) && $config_apim[0]['accessToken'] != '' && $config_apim[0]['subscriptionId'] != '' && $config_apim[0]['resourceGroup'] != '' && $config_apim[0]['serviceId'] != '') {
        $url = 'https://'.$config_apim[0]["serviceId"].'.management.azure-api.net/subscriptions/'.$config_apim[0]["subscriptionId"].'/resourceGroups/'.$config_apim[0]["resourceGroup"].'/providers/Microsoft.ApiManagement/service/'.$config_apim[0]["serviceId"].'/apis?api-version=2021-08-01';
        ?>
        <a action-id="<?php echo $url; ?>" name="<?php echo $url; ?>" id="testapim" class="btn btn-primary">Test Azure API Management configuration</a> <div id="responseTestAPIM"></div>

        <?php
        }
?>

<!-- Access Token Modal -->
<div class="modal fade" id="modalAccessToken" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                        <form method="post">

                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Set New Access Token</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                                <div class="modal-body">
                                        <div class="form-group">
                                                <label for="txtaccesstoken" class="col-sm-4 col-form-label">Access Token</label>
                                                <div class="col-sm-8">
                                                        <input type="text" id="txtaccesstoken" name="txtaccesstoken" style="width:100%">
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" name="saveAccessToken">Save Access Token</button>
                        </div>
                </form>
                </div>
        </div>
</div>

<!-- Subscription Id Modal -->
<div class="modal fade" id="modalSubscriptionId" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
                <div class="modal-content">
                        <form method="post">

                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Set New Subscription Id</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                                <div class="modal-body">
                                        <div class="form-group">
                                                <label for="txtsubscriptionid" class="col-sm-4 col-form-label">Subscription Id</label>
                                                <div class="col-sm-8">
                                                        <input type="text" id="txtsubscriptionid" name="txtsubscriptionid" style="width:100%">
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" name="saveAccessToken">Save Subscription Id</button>
                        </div>
                </form>
                </div>
        </div>
</div>

<!-- Resource Group Modal -->
<div class="modal fade" id="modalResourceGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
                <div class="modal-content">
                        <form method="post">

                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Set New Resource Group</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                                <div class="modal-body">
                                        <div class="form-group">
                                                <label for="txtresourcegroup" class="col-sm-4 col-form-label">Resource Group</label>
                                                <div class="col-sm-8">
                                                        <input type="text" id="txtresourcegroup" name="txtresourcegroup" style="width:100%">
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" name="saveAccessToken">Save Resource Group</button>
                        </div>
                </form>
                </div>
        </div>
</div>

<!-- Service Name Modal -->
<div class="modal fade" id="modalServiceId" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                        <form method="post">

                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Set New Service Name</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                                <div class="modal-body">
                                        <div class="form-group">
                                                <label for="txtserviceid" class="col-sm-4 col-form-label">Service Name</label>
                                                <div class="col-sm-8">
                                                        <input type="text" id="txtserviceid" name="txtserviceid" style="width:100%">
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" name="saveAccessToken">Save Service Name</button>
                        </div>
                </form>
                </div>
        </div>
</div>
