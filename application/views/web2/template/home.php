<div class="row mr-0 ml-0 mb-5  grey-bg" id="offers">
    <div class="container">
        <div class="offer-title text-center">
            <h2><b>Discover Restaurants by Popular Cuisine</b></h2>
        </div>
        <div class="home-filter-list">
            <div class="home-filter-box">
                <ul class="nav nav-pills mb-3 list-filter" id="pills-tab" role="tablist">
                  <li class="nav-item">                            
                    <a class="nav-link active" id="pills-pizza" data-toggle="pill" href="#pizza-list" role="tab" aria-controls="pizza-list" aria-selected="true"><img src="<?php echo $assets; ?>images/PIZZA.png">pizza</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-italian" data-toggle="pill" href="#italian-list" role="tab" aria-controls="italian-list" aria-selected="false"><img src="<?php echo $assets; ?>images/Italian.png">italian</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-mexican" data-toggle="pill" href="#mexican-list" role="tab" aria-controls="mexican-list" aria-selected="false"><img src="<?php echo $assets; ?>images/Maxican.png">mexican</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-american" data-toggle="pill" href="#american-list" role="tab" aria-controls="american-list" aria-selected="false"><img src="<?php echo $assets; ?>images/American.png">american</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="sushi" data-toggle="pill" href="#sushi-list" role="tab" aria-controls="sushi-list" aria-selected="false"><img src="<?php echo $assets; ?>images/SUSHI.png">sushi</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-barbecue" data-toggle="pill" href="#barbecue-list" role="tab" aria-controls="barbecue-list" aria-selected="false"><img src="<?php echo $assets; ?>images/Barbecue.png">barbecue</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-chinese" data-toggle="pill" href="#chinese-list" role="tab" aria-controls="chinese-list" aria-selected="false"><img src="<?php echo $assets; ?>images/Chinese.png">chinese</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-thai" data-toggle="pill" href="#thai-list" role="tab" aria-controls="thai-list" aria-selected="false"><img src="<?php echo $assets; ?>images/Thai.png">thai</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-japanese" data-toggle="pill" href="#japanese-list" role="tab" aria-controls="japanese-list" aria-selected="false"><img src="<?php echo $assets; ?>images/Japanese.png">japanese</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-indian" data-toggle="pill" href="#indian-list" role="tab" aria-controls="indian-list" aria-selected="false"><img src="<?php echo $assets; ?>images/Indian.png">indian</a>
                  </li>
                  <li class="nav-item">                              
                    <a class="nav-link" id="pills-desserts" data-toggle="pill" href="#desserts-list" role="tab" aria-controls="desserts-list" aria-selected="false"><img src="<?php echo $assets; ?>images/Desserts.png">desserts</a>
                  </li>
                </ul>                   
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="pizza-list" role="tabpanel" aria-labelledby="pills-pizza">
                    <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div> 
                </div>
                <div class="tab-pane fade " id="italian-list" role="tabpanel" aria-labelledby="pills-italian">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="mexican-list" role="tabpanel" aria-labelledby="pills-mexican">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="american-list" role="tabpanel" aria-labelledby="pills-american">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="sushi-list" role="tabpanel" aria-labelledby="pills-sushi">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="barbecue-list" role="tabpanel" aria-labelledby="pills-barbecue">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="chinese-list" role="tabpanel" aria-labelledby="pills-chinese">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="thai-list" role="tabpanel" aria-labelledby="pills-thai">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="japanese-list" role="tabpanel" aria-labelledby="pills-japanese">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="indian-list" role="tabpanel" aria-labelledby="pills-indian">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="tab-pane fade " id="desserts-list" role="tabpanel" aria-labelledby="pills-desserts">
                     <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="">Sort By High</option>
                                     <option value="">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title" >Over</label>
                                        <label  for="#review-star1" class="review-icon" ><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star" id="review-star1">                                     
                                         <option class="sort-dev" value="Over" disabled selected hidden data-imagesrc="<?php echo $assets; ?>images/01.png">4.5</option>       
                                         <option value="1" >1</option>
                                         <option value="1" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Pickup1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Pickup1">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Popular1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Popular1">Popular</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div>
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="" >Sort By High</option>
                                     <option value="" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                    </div>
                </div>
            </div>
    </div> 
        <div class="offer-title2 mt-5">
            <div class="text-center">
                <label class="label1 mr-3"><a href="#">Combo Offers</a></label>
                <label class="label2 mr-3 active"><a href="#">Nearby Restaurant</a></label>
                <!-- <label class="fliter mr-3"><a href="#address-pop" data-toggle="modal"><img src="images/filter.png"></a></label> -->
            </div>
        </div>
        <div class="restaurant row mt-4">
            <div class="col-lg-3 px-2">
                <div class="card">
                    <div class="restaurant-img position-relative">
                        <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/555a01584ae7cee5d6c3288c1ec67ba8.jpg?fit=around%7C800%3A533&amp;crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                        <div class="rating txt1">Ratings</div>
                        <div class="rating txt2 txt-red">4.2</div>
                    </div>
                    <div class="card-body restaurant-body">
                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                            <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                            <b>
                                <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                            </b>
                            <div class="position-relative txt-black font-14 pl-4 cusion">
                                Burger, Maxican
                            </div>
                            <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                            <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                        </a>
                    </div>
                     <div class="restaurant-hover">
                        <div class="restaurant-hover-list">
                            <div class="restaurant-hover-img like">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                            </div>
                             <div class="restaurant-hover-img">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 px-2">
                <div class="card">
                    <div class="restaurant-img position-relative">
                        <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/782292fdf7327e4d450d79b2c2db4301.jpg?fit=around%7C640%3A640&amp;crop=640%3A640%3B%2A%2C%2A" alt="Card image cap">
                        <div class="rating txt1">Ratings</div>
                        <div class="rating txt2 txt-red">4.2</div>
                    </div>
                     <div class="card-body restaurant-body">
                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                            <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                            <b>
                                <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                            </b>
                            <div class="position-relative txt-black font-14 pl-4 cusion">
                                Burger, Maxican
                            </div>
                            <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                            <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                        </a>
                    </div>
                     <div class="restaurant-hover">
                        <div class="restaurant-hover-list">
                            <div class="restaurant-hover-img like">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                            </div>
                             <div class="restaurant-hover-img">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 px-2">
                <div class="card">
                    <div class="restaurant-img position-relative">
                        <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/a64a1a5a18a4ddcd36ba65d8ce64ed4c.jpg?fit=around%7C800%3A442&amp;crop=800%3A442%3B%2A%2C%2A" alt="Card image cap">
                        <div class="rating txt1">Ratings</div>
                        <div class="rating txt2 txt-red">4.2</div>
                    </div>
                     <div class="card-body restaurant-body">
                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                            <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                            <b>
                                <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                            </b>
                            <div class="position-relative txt-black font-14 pl-4 cusion">
                                Burger, Maxican
                            </div>
                            <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                            <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                        </a>
                    </div>
                     <div class="restaurant-hover">
                        <div class="restaurant-hover-list">
                            <div class="restaurant-hover-img like">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                            </div>
                             <div class="restaurant-hover-img">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 px-2">
                <div class="card">
                    <div class="restaurant-img position-relative">
                        <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/32ab199fc3cf963b6177515306462ec8.jpg?fit=around%7C800%3A533&amp;crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                        <div class="rating txt1">Ratings</div>
                        <div class="rating txt2 txt-red">4.2</div>
                    </div>
                   <div class="card-body restaurant-body">
                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                            <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                            <b>
                                <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                            </b>
                            <div class="position-relative txt-black font-14 pl-4 cusion">
                                Burger, Maxican
                            </div>
                            <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                            <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                        </a>
                    </div>
                     <div class="restaurant-hover">
                        <div class="restaurant-hover-list">
                            <div class="restaurant-hover-img like">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                            </div>
                             <div class="restaurant-hover-img">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 px-2">
                <div class="card">
                    <div class="restaurant-img position-relative">
                        <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/555a01584ae7cee5d6c3288c1ec67ba8.jpg?fit=around%7C800%3A533&amp;crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                        <div class="rating txt1">Ratings</div>
                        <div class="rating txt2 txt-red">4.2</div>
                    </div>
                     <div class="card-body restaurant-body">
                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                            <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                            <b>
                                <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                            </b>
                            <div class="position-relative txt-black font-14 pl-4 cusion">
                                Burger, Maxican
                            </div>
                            <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                            <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                        </a>
                    </div>
                     <div class="restaurant-hover">
                        <div class="restaurant-hover-list">
                            <div class="restaurant-hover-img like">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                            </div>
                             <div class="restaurant-hover-img">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 px-2">
                <div class="card">
                    <div class="restaurant-img position-relative">
                        <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/782292fdf7327e4d450d79b2c2db4301.jpg?fit=around%7C640%3A640&amp;crop=640%3A640%3B%2A%2C%2A" alt="Card image cap">
                        <div class="rating txt1">Ratings</div>
                        <div class="rating txt2 txt-red">4.2</div>
                    </div>
                     <div class="card-body restaurant-body">
                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                            <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                            <b>
                                <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                            </b>
                            <div class="position-relative txt-black font-14 pl-4 cusion">
                                Burger, Maxican
                            </div>
                            <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                            <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                        </a>
                    </div>
                     <div class="restaurant-hover">
                        <div class="restaurant-hover-list">
                            <div class="restaurant-hover-img like">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                            </div>
                             <div class="restaurant-hover-img">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 px-2">
                <div class="card">
                    <div class="restaurant-img position-relative">
                        <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/a64a1a5a18a4ddcd36ba65d8ce64ed4c.jpg?fit=around%7C800%3A442&amp;crop=800%3A442%3B%2A%2C%2A" alt="Card image cap">
                        <div class="rating txt1">Ratings</div>
                        <div class="rating txt2 txt-red">4.2</div>
                    </div>
                     <div class="card-body restaurant-body">
                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                            <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                            <b>
                                <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                            </b>
                            <div class="position-relative txt-black font-14 pl-4 cusion">
                                Burger, Maxican
                            </div>
                            <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                            <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                        </a>
                    </div>
                     <div class="restaurant-hover">
                        <div class="restaurant-hover-list">
                            <div class="restaurant-hover-img like">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                            </div>
                             <div class="restaurant-hover-img">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 px-2">
                <div class="card">
                    <div class="restaurant-img position-relative">
                        <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/32ab199fc3cf963b6177515306462ec8.jpg?fit=around%7C800%3A533&amp;crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                        <div class="rating txt1">Ratings</div>
                        <div class="rating txt2 txt-red">4.2</div>
                    </div>
                     <div class="card-body restaurant-body">
                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                            <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                            <b>
                                <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                            </b>
                            <div class="position-relative txt-black font-14 pl-4 cusion">
                                Burger, Maxican
                            </div>
                            <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                            <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                        </a>
                    </div>
                     <div class="restaurant-hover">
                        <div class="restaurant-hover-list">
                            <div class="restaurant-hover-img like">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                            </div>
                             <div class="restaurant-hover-img">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mr-0 ml-0" id="features">
    <div class="container p-5">
        <div class="feature-header">
            <h1 class="text-center m-15 letter-space-1"><b>Lunch should be simple</b></h1>
            <h6 class="text-center text-uppercase letter-space-2">and that's why we're here.</h6>
        </div>
        <div class="features-div row text-center">
            <div class="col-lg-4 pt-5">
                <img src="http://13.58.201.178/assets/images/home-page/Time-Is-Money.png" alt="Time is Money">
                <div class="m-4">
                    <h5><strong>Time is Money</strong></h5>
                    <h6 class="feature-txt-2">More "you time" to do what is important</h6>
                </div>
            </div>
            <div class="col-lg-4 pt-5">
                <img src="http://13.58.201.178/assets/images/home-page/Easy-To-Use.png" alt="Time is Money">
                <div class="m-4">
                    <h5><strong>Easy to Use</strong></h5>
                    <h6 class="feature-txt-2">The lunch you want in a few simple clicks</h6>
                </div>
            </div>
            <div class="col-lg-4 pt-5">
                <img src="http://13.58.201.178/assets/images/home-page/Peace-Of-Mind.png" alt="Time is Money">
                <div class="m-4">
                    <h5><strong>Peace-of-Mind</strong></h5>
                    <h6 class="feature-txt-2">Reliable delivery from the brands you trust</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mr-0 ml-0" id="slider-2">
    <div class="col-lg-12 p-0">
        <div class=row">
            <div class="card-body bg-cyan">
                <div id="carouselExampleIndicators" class="carousel slide label-slider p-5 text-center" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner text-white" role="listbox">
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center">
                                <div class="carousel-txt text-uppercase d-flex">
                                    <div class="stats-number">98.3</div>
                                </div>
                                <div class="stats-content d-flex">
                                    <div class="stats-first-line">% Lunches delivered</div>
                                    <div class="stats-second-line">Accurately and on-time</div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center">
                                <div class="carousel-txt text-uppercase d-flex">
                                    <div class="stats-number">27</div>
                                </div>
                                <div class="stats-content d-flex">
                                    <div class="stats-first-line">Minutes saved</div>
                                    <div class="stats-second-line">Per Click Lunch order</div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center">
                                <div class="carousel-txt text-uppercase d-flex">
                                    <div class="stats-number">12</div>
                                </div>
                                <div class="stats-content d-flex">
                                    <div class="stats-first-line">Restaurant</div>
                                    <div class="stats-second-line">options per week (avg.)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>

<div class="row center-xs app-row-new" id="partners">
    <div class="container p-5 text-center">
        <div class="partners-header mb-5">
            <h1 class="text-center m-15 letter-space-1"><b>Restaurant Partners</b></h1>
            <h6 class="text-center text-uppercase letter-space-2">your favorite local and national restaurants - now delivering.</h6>
        </div>
        <img src="http://13.58.201.178/assets/images/home-page/Restaurent-Partner.png" alt="Time is Money" class="w-100">
    </div>
</div>

<!-- testimonial slider -->
<div class="row mb-5 mt-5 ml-0 mr-0" id="testimonial-slider">
    <div class="container">
        <div id="qunit"></div>
        <div id="qunit-fixture">
            <div id="navhere"></div>
            <ul id="simple" class="row owl-carousel">
                <li>
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                    <div class="bg-white text-center">
                        <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                        </div>
                        <div class="p-3">
                            <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                            <h6 class="text-black-50">L'Enclume</h6>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                    <div class="bg-white text-center">
                        <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                        It is a long esta as opposed to using 'Content here, content here', making it look like readable English
                        </div>
                        <div class="p-3">
                            <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                            <h6 class="text-black-50">L'Enclume</h6>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                    <div class="bg-white text-center">
                        <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                        </div>
                        <div class="p-3">
                            <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                            <h6 class="text-black-50">L'Enclume</h6>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                    <div class="bg-white text-center">
                        <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                        </div>
                        <div class="p-3">
                            <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                            <h6 class="text-black-50">L'Enclume</h6>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                    <div class="bg-white text-center">
                        <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                        </div>
                        <div class="p-3">
                            <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                            <h6 class="text-black-50">L'Enclume</h6>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                    <div class="bg-white text-center">
                        <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                        </div>
                        <div class="p-3">
                            <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                            <h6 class="text-black-50">L'Enclume</h6>
                        </div>
                    </div>
                </li>
            </ul>
         

        </div>
    </div>
</div>

<div class="row mt-5 mr-0 ml-0" id="how-it-work">
    <div class="container p-5">
        <div class="feature-header">
            <h1 class="text-center m-15 letter-space-1"><b>How it Works</b></h1>
            <h6 class="text-center text-uppercase letter-space-2">ClickLunch is a lunch delivery service specially for office professionals.</h6>
        </div>
        <div class="how-it-work-div row text-center">
            <div class="col-lg-4 pt-5">
                <img src="http://13.58.201.178/assets/images/home-page/Order-Online.png" alt="Time is Money">
                <div class="m-4">
                    <h5><strong>Order Online</strong></h5>
                    <h6 class="feature-txt-2">Normal menu prices and $1.99 delivery</h6>
                </div>
            </div>
            <div class="col-lg-4 pt-5">
                <img src="http://13.58.201.178/assets/images/home-page/Restaurent-Delivers.png" alt="Time is Money">
                <div class="m-4">
                    <h5><strong>Easy to Use</strong></h5>
                    <h6 class="feature-txt-2">No tipping and no minimums</h6>
                </div>
            </div>
            <div class="col-lg-4 pt-5">
                <img src="http://13.58.201.178/assets/images/home-page/Enjoy-Your-Meal.png" alt="Time is Money">
                <div class="m-4">
                    <h5><strong>Peace-of-Mind</strong></h5>
                    <h6 class="feature-txt-2">We'll notify you when your meal arrives</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row center-xs app-row-new">
    <div class="col-xs-12 col-sm-6 app-text text-left">
        <h1 class="txt-red text-uppercase"><b>order on the go.</b></h1>
        <h4 class="m-0">Get the food you love</h4>
        <h4 class="m-1">with the clicklunch app.</h4>
         <div class="mt-4">
            <a href="https://bnc.lt/download-zomato-ios"><img src="http://13.58.201.178/assets/images/home-page/Apple-Play-Store.png" alt="Apple Play Store" class="mr-3"></a>
            <a href="https://bnc.lt/download-z-android"><img src="http://13.58.201.178/assets/images/home-page/Google-Play-Store.png" alt="Google Play Store"></a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 pt-5 pb-5">
        <img class="app-image" src="http://13.58.201.178/assets/images/home-page/Mobile.png" alt="Click Lunch">
    </div>
</div>

<div class="row pt-5 white-bg mr-0 ml-0 justify-content-center">
    <div class="mail-subscription-block">
        <div class="mail-subscription-custom-text text-center"><p>Be the lucky winner to get FREE meals for one week. <br> We are also offer you latest deal in your inbox</p></p></div>
        <form class="mail-subscription d-flex align-items-center" id="mailSubscription">
            <input type="email" name="email" class="form-control" id="mailSubscriptionId" placeholder="Enter your e-mail address here" />
            <input type="submit" name="subscribe" value="Subscribe" class="subscribe-btn red-btn" />
        </form>
    </div>
</div>