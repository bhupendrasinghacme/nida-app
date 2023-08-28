<?php 
if(isset($data['country_currency']) && !empty($data['country_currency'])){
      foreach ($data['country_currency'] as $currency) { 
        if($currency->country_code  !=''){
          if($currency->default_country == 1){
           $base_currency = $currency->country_currency;
              }
             }
      }
}
             if(!empty($data['products'])){
              $original_product_data = $data['products'];
     
               for($i=0;$i<sizeof($data['products']);$i++)
                {
                  $hascountry = false;
                  $total_options = sizeof($data['products'][$i]['options']);
                  for($j=0;$j<$total_options;$j++){
                    if($data['products'][$i]['options'][$j]['name'] == 'Country'){
                      $hascountry = true;
                    }
                  }
                  ?>
                <form method="post" class="individual-form-part" id="form-<?php echo $data['products'][$i]['id'] ?>">
               
                <input type="hidden" data-token="<?php echo $data['access_token'] ?>"  class="access_token">
                <div class="inner_product_wrapper" data-title="<?php echo $data['products'][$i]['title']; ?>">

                  <div class="product-head-wrapper">
                    <div class="product-image">
                      <?php
                      if($data['products'][$i]['image'] != null && $data['products'][$i]['image'] != '' && !empty($data['products'][$i]['image'])){
                        ?>
                        <img src="<?php print_r($data['products'][$i]['image']['src'])?>"/>
                        <?php
                      }
                      ?>
                      
                      <div class="product-title"><?php echo $data['products'][$i]['title']; ?></div>
                    </div>

                    <div class="add_variant_cover Polaris-ButtonGroup__Item">
                      <button type="button" class="Polaris-Button Polaris-Button--primary add_variant" data-id="<?php echo $data['products'][$i]['id'] ?>"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Save</span></span>
                      </button>
                    </div>

                    <div class="delete_icon delete-product" data-id="<?php echo $data['products'][$i]['id'] ?>">
                      <button class="Polaris-Button" type="button">
                        <span class="Polaris-Button__Content">
                          <span class="Polaris-Button__Text">
                            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17 9a1 1 0 01-1-1c0-.551-.448-1-1-1H5.414l1.293 1.293a.999.999 0 11-1.414 1.414l-3-3a.999.999 0 010-1.414l3-3a.997.997 0 011.414 0 .999.999 0 010 1.414L5.414 5H15c1.654 0 3 1.346 3 3a1 1 0 01-1 1zM3 11a1 1 0 011 1c0 .551.448 1 1 1h9.586l-1.293-1.293a.999.999 0 111.414-1.414l3 3a.999.999 0 010 1.414l-3 3a.999.999 0 11-1.414-1.414L14.586 15H5c-1.654 0-3-1.346-3-3a1 1 0 011-1z" fill="#000"></svg>
                          </span>
                        </span>
                      </button>
                      </svg>
                    </div>
                  </div> 

                  <div class="Polaris-DataTable product-table">
                    <div class="Polaris-DataTable__ScrollContainer">
                      <table class="Polaris-DataTable__Table">
                        <thead>
                          <tr>
                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Variants</th>
                            <?php if(isset($data['country_currency']) && !empty($data['country_currency'])){ foreach ($data['country_currency'] as $currency) {  
                              if($currency->country_code != ''){
                              ?>
                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col" <?php if ($currency->default_country == 1){ ?>style="display: none;"<?php }?>><?php echo $currency->country_code ?></th>
                            <?php } } } ?>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $product_id = $data['products'][$i]['id'];
                          $variant_url = "https://".$data['shop']."/admin/api/2021-04/products/".$product_id."/variants.json";
                          $variant_data_get = $data['curl_controller']->curl_get_fun($variant_url,$data['access_token']);
                          $variant_data = $variant_data_get['variants'];
                        if($hascountry){

                          // if country option exist
                          $variant_title_array = [];
                          $variant_sku_array = [];
                          foreach ($variant_data as $variant){
                            array_push($variant_title_array,substr($variant['title'], 0,strrpos($variant['title'], ' / ')));
                            array_push($variant_sku_array,$variant['sku']);
                          }
                         $variant_title_array_unique = array_values(array_unique($variant_title_array));
                         $variant_sku_array_unique = array_values(array_unique($variant_sku_array));
                         for($v=0;$v<sizeof($variant_title_array_unique);$v++){
                          ?>
                          <tr class="Polaris-DataTable__TableRow">
                            <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">
                              <?php echo $variant_title_array_unique[$v]; ?>
                               <div>SKU: <?php echo $variant_sku_array_unique[$v]; ?></div>
                            </th>
                            <?php
                            foreach ($data['country_currency'] as $key => $currency) {
                            if($currency->country_code != ''){
                              $currency_variant_exist = false;
                              $normal_price = '';
                              $compare_price = '';
                              foreach ($variant_data as $variant){
                                if($variant['title'] == $variant_title_array_unique[$v].' / '.$currency->country_code ){

                                  $currency_variant_exist = true;
                                      $normal_price = number_format(($variant['price'] * $data['conversion_data'][$base_currency])/$data['conversion_data'][$currency->country_currency],2);
                                   
                                        if($variant['compare_at_price'] != '' && $variant['compare_at_price'] != null){
                                        $compare_price = number_format(($variant['compare_at_price'] * $data['conversion_data'][$base_currency])/$data['conversion_data'][$currency->country_currency],2);
                                      }
                                      else{
                                        $compare_price='';
                                      }
                      
                                ?>
                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric" <?php if ($currency->default_country == 1){ ?>style="display: none;"<?php }?>>
                                  
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Price:</label>
                                    </div>
                                  </div>

                                  <div class="Polaris-Connected">
                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                                        <input id="" class="Polaris-TextField__Input <?php if ($currency->default_country != 1){ ?> normal-price <?php  }?>" type="text" name="price_<?php echo $variant['title']; ?>" value="<?php echo $normal_price;?>">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                      </div>
                                    </div>
                                  </div>
                                 
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Compare Price:</label>
                                    </div>
                                  </div>

                                  <div class="Polaris-Connected">
                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                                        <input id="" class="Polaris-TextField__Input compare-price" type="text" name="compareprice_<?php echo $variant['title'] ?>" value="<?php echo $compare_price;?>">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                      </div>
                                    </div>
                                  </div>

                                </td>
                                <?php
                              }

                            }
                         
                                if(!$currency_variant_exist){
                                ?>
                                 <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric" <?php if ($currency->default_country == 1){ ?>style="display: none;"<?php }?>>
                                  
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Price:</label>
                                    </div>
                                  </div>

                                  <div class="Polaris-Connected">
                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                                        <input id="" class="Polaris-TextField__Input <?php if ($currency->default_country != 1){ ?> normal-price <?php  }?>" type="number" name="price_<?php echo $variant_title_array_unique[$v]; ?> / <?php echo $currency->country_code ?>" value="<?php echo $normal_price;?>">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                      </div>
                                    </div>
                                  </div>
                                 
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Compare Price:</label>
                                    </div>
                                  </div>

                                  <div class="Polaris-Connected">
                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                                        <input id="" class="Polaris-TextField__Input compare-price" type="text" name="compareprice_<?php echo $variant['title'] ?> / <?php echo $currency->country_code ?>" value="<?php echo $compare_price;?>">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                      </div>
                                    </div>
                                  </div>

                                </td>
                                <?php
                              }
                            }
                          }
                          ?>
                        </tr>
                        <?php
                         }
                        }
                        else{
                          // if country option not exist
                          foreach ($variant_data as $variant) {
                            ?>
                            <tr class="Polaris-DataTable__TableRow">
                            <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">
                            <?php echo $variant['title'] ?>
                            <div>SKU: <?php echo $variant['sku'] ?></div>
                            </th>
                            <?php if(isset($data['country_currency']) && !empty($data['country_currency'])){ foreach ($data['country_currency'] as $key => $currency) { 
                      if($currency->country_code != ''){
                             ?>

                            <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric" <?php if ($currency->default_country == 1){ ?>style="display: none;"<?php }?>>

                              <div class="Polaris-Labelled__LabelWrapper">
                                <div class="Polaris-Label">
                                  <label id="" for="PolarisTextField8" class="Polaris-Label__Text">Price:</label>
                                </div>
                              </div>

                              <div class="Polaris-Connected">
                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                  <div class="Polaris-TextField Polaris-TextField--hasValue">
                                    <input type="text" class="Polaris-TextField__Input <?php if ($currency->default_country != 1){ ?> normal-price <?php  }?>" name="price_<?php echo $variant['title'] ?> / <?php echo $currency->country_code ?>">
                                    <div class="Polaris-TextField__Backdrop"></div>
                                  </div>
                                </div>
                              </div>
                             
                              <div class="Polaris-Labelled__LabelWrapper">
                                <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Compare Price:</label>
                                </div>
                              </div>

                              <div class="Polaris-Connected">
                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                  <div class="Polaris-TextField Polaris-TextField--hasValue">
                                    <input type="text" class="Polaris-TextField__Input compare-price" name="compareprice_<?php echo $variant['title'] ?> / <?php echo $currency->country_code ?>">
                                    <div class="Polaris-TextField__Backdrop"></div>
                                  </div>
                                </div>
                              </div>

                            </td>
                            <?php } } } ?>
                          </tr>
                            <?php
                          }
                        }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>

                </form>
                <?php
               

                  }

                }

                ?>
                <div class="hide next-token" data-page-token="<?php echo $data['next_page_token'];?>"></div>