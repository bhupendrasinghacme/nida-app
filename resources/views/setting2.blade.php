<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="{{ asset('/css/styles.min.css') }}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #f4f6f8 !important;">

<div class="container-fluid">
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#setting">Setting</a></li>
    <li><a data-toggle="pill" href="#support">Support</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="setting" class="tab-pane fade in active">
          <form class="form-horizontal" action="/create_snippet" method="post">
            @if(isset($_GET['msg']))
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               {{ $_GET['msg'] }}
            </div>
            @endif
            <div class="form-group">
              <label class="control-label col-sm-2" for="">Theme Selection:</label>
              <div class="col-sm-4">
                <input type="hidden" name="shopify_domain" value="{{ $_GET['shop'] }}">
                <select class="form-control" name="shopify_theme">
                    @foreach ($theme_data as $theme)
                    <option value="{{ $theme['id'] }}">{{ $theme['name'] }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <button type="submit" name="save_code" class="btn btn-default">Save</button>
          </form>
            <form class="form-horizontal" action="/shopify_app" method="post">
            <input type="hidden" name="store_id" value="{{ $shop_info->id }}">
            <input type="hidden" name="shop" value="{{ $shop_info->store_url }}">
            <div class="form-group">
                <label class="control-label col-sm-2" for="">Authentication Key:</label>
                <div class="col-sm-4"><input class="form-control" type="text" name="authentication_key" placeholder="Authentication Key" required></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="">UserName:</label>
                <div class="col-sm-4"><input class="form-control" type="text" name="user_name" placeholder="" required></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="">Password</label>
                <div class="col-sm-4"><input class="form-control" type="password" name="password" placeholder="" required></div>
            </div>
            <label class="control-label col-sm-12" for="">Select Attribute:</label>
            <div class="col-sm-4">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Customer Name</th>
                      <th>Customer Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($customer_data as $customer)
                    <tr>
                      <td>{{ $customer['first_name'] }}&nbsp;{{ $customer['last_name'] }}</td>
                      <td>{{ $customer['email'] }}</td>
                    </tr> 
                    @endforeach
                  </tbody>
                </table>
            </div>
            <div class="col-sm-8">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Customer Attributes</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                      <td>
                          <input type="hidden" name="customer_id" value="{{ $customer['id'] }}">
                          <label class="checkbox-inline">
                          <input type="checkbox" value="id" name="id">Id
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="email" name="email">Email
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="accepts_marketing" name="accepts_marketing">Accepts Marketing
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="created_at" name="created_at">created_at
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="updated_at" name="updated_at">updated_at
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="first_name" name="first_name">first_name
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="last_name" name="last_name">last_name
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="orders_count" name="orders_count">orders_count
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="state" name="state">state
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="total_spent" name="total_spent">total_spent
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="last_order_id" name="last_order_id">last_order_id
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="note" name="note">note
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="verified_email" name="verified_email">verified_email
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="multipass_identifier" name="multipass_identifier">multipass_identifier
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="tax_exempt" name="tax_exempt">tax_exempt
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="phone" name="phone">phone
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="tags" name="tags">tags
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="last_order_name" name="last_order_name">last_order_name
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="currency" name="currency">currency
                          </label>
                          <p><strong>addresses:</strong></p>
                          @foreach ($customer['addresses'][0] as $key => $addresse)
                            <label class="checkbox-inline">
                              <input type="checkbox" value="{{ $key }}" name="address_{{ $key }}">{{ $key }}
                            </label>
                          @endforeach
                      </td>
                    </tr> 
                    
                  </tbody>
                </table>
            </div>
            <button type="submit" name="save_attr" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div id="support" class="tab-pane fade">
      <h3>Support</h3>
    </div>
  </div>
</div>
</body>
</html>
<script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
<script type="text/javascript">
  var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };
    var shop_url = getUrlParameter('shop');
  ShopifyApp.init({
      apiKey: "94c1c40075ea2c9d617a48914c13dde7",
      shopOrigin:"https://"+shop_url,
      debug: false,
      forceRedirect: true
    });
    ShopifyApp.ready(function(){
        ShopifyApp.Bar.loadingOff();
    })
 </script>