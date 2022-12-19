<div class="container-fluid full" style="background-color: #F7F8FC;">
	<!--product-->
	<div class="bbb_viewed">
        <!-- Cái Menu này chia làm 3 hàng, có 2 cách:
					- nếu m lặp luôn thì khi m bấm previous hay next thì nó sẽ chạy hết cả lũ
					- không lặp, nó sẽ chạy độc lập, t đang làm theo cách này, nhìn ok hơn
         -->
        <!-- ====================Lặp ở dưới==================== -->
        <!-- 1 -->
		<div class="container-fluid">
		    <div class="row mx-0">
		        <div class="col">
		            <div class="bbb_main_container">
		                <div class="bbb_viewed_title_container">
		                    <h3 class="bbb_viewed_title">BÁNH KEM</h3>
		                    <div class="bbb_viewed_nav_container">
		                        <div class="bbb_viewed_nav aaa_viewed_prev"><i class="fas fa-chevron-left"></i></div>
		                        <div class="bbb_viewed_nav aaa_viewed_next"><i class="fas fa-chevron-right"></i></div>
		                    </div>
		                </div>
		                <div class="bbb_viewed_slider_container">
		                    <div class="owl-carousel owl-theme aaa_viewed_slider owl-loaded owl-drag">  
		                        <div class="owl-stage-outer">
		                        	<div class="owl-stage" style="transform: translate3d(-1813px, 0px, 0px); transition: all 0s ease 0s; width: 3108px;">

		                        		<!--(Lặp nhiều 1 chút, t để 1 sp nó chạy full không sao, cứ đổ vô là nó chạy lần lượt, phía cuối nó có 1 khoảng trống thì kệ nó, không ai quan tâm đâu)		
		                        		-->

		                        		<?php
											$loaicakes = loai_cakes(1);
											foreach($loaicakes as $lc):
												$pt = 100 - (($lc["GiaGiam"]*100)/$lc["GiaGoc"]);
                								$pt = round($pt, 0, PHP_ROUND_HALF_UP);
										?>
		                        		<!-- Lặp -->
		                        		<div class="owl-item sp" >
			                            	<div class="owl-item">
			                                    <div class="bbb_viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
			                                        <div class="bbb_viewed_image"><img src="public/img/cakes/<?php echo $lc["Anh"]; ?>" alt=""></div>
			                                        <div class="bbb_viewed_content text-center">
			                                            <div class="bbb_viewed_price"><?php echo number_format($lc["GiaGiam"], 0, ",", "."); ?><sup> đ</sup></div>
			                                            <div class="bbb_viewed_name"><a href="./?p=cake&idCake=<?php echo $lc["idCake"]; ?>&name=<?php echo $lc["TenKD"]; ?>"><?php echo $lc["TenBanh"]; ?></a></div>
			                                        </div>
			                                        <ul class="item_marks">
														<li class="item_mark item_new">-<?php echo $pt; ?>%</li>
			                                        </ul>
			                                    </div>
			                                </div>
			                            </div>
			                            <!-- Lặp -->
										<?php
											endforeach;
										?>
		                    		</div>
		                		</div>
		                    	<div class="owl-nav disabled">
		                    		<div class="owl-prev">prev</div>
		                    		<div class="owl-next">next</div>
			                    </div>
		                	</div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
        <!-- 2 -->
        <div class="container-fluid">
		    <div class="row mx-0">
		        <div class="col">
		            <div class="bbb_main_container">
		                <div class="bbb_viewed_title_container">
		                    <h3 class="bbb_viewed_title">BÁNH DONUT</h3>
		                    <div class="bbb_viewed_nav_container">
		                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
		                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
		                    </div>
		                </div>
		                <div class="bbb_viewed_slider_container">
		                    <div class="owl-carousel owl-theme bbb_viewed_slider owl-loaded owl-drag">  
		                        <div class="owl-stage-outer">
		                        	<div class="owl-stage" style="transform: translate3d(-1813px, 0px, 0px); transition: all 0s ease 0s; width: 3108px;">

		                        		<!--(Lặp nhiều 1 chút, t để 1 sp nó chạy full không sao, cứ đổ vô là nó chạy lần lượt, phía cuối nó có 1 khoảng trống thì kệ nó, không ai quan tâm đâu)		
		                        		-->

		                        		<?php
											$loaicakes = loai_cakes(7);
											foreach($loaicakes as $lc):
												$pt = 100 - (($lc["GiaGiam"]*100)/$lc["GiaGoc"]);
                								$pt = round($pt, 0, PHP_ROUND_HALF_UP);
										?>
		                        		<!-- Lặp -->
		                        		<div class="owl-item sp" >
			                            	<div class="owl-item">
			                                    <div class="bbb_viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
			                                        <div class="bbb_viewed_image"><img src="public/img/cakes/<?php echo $lc["Anh"]; ?>" alt=""></div>
			                                        <div class="bbb_viewed_content text-center">
			                                            <div class="bbb_viewed_price"><?php echo number_format($lc["GiaGiam"], 0, ",", "."); ?><sup> đ</sup></div>
			                                            <div class="bbb_viewed_name"><a href="./?p=cake&idCake=<?php echo $lc["idCake"]; ?>&name=<?php echo $lc["TenKD"]; ?>"><?php echo $lc["TenBanh"]; ?></a></div>
			                                        </div>
			                                        <ul class="item_marks">
														<li class="item_mark item_new">-<?php echo $pt; ?>%</li>
			                                        </ul>
			                                    </div>
			                                </div>
			                            </div>
			                            <!-- Lặp -->
										<?php
											endforeach;
										?>
		                    		</div>
		                		</div>
		                    	<div class="owl-nav disabled">
		                    		<div class="owl-prev">prev</div>
		                    		<div class="owl-next">next</div>
			                    </div>
		                	</div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
        <!-- 3 -->
		<div class="container-fluid">
		    <div class="row mx-0">
		        <div class="col">
		            <div class="bbb_main_container">
		                <div class="bbb_viewed_title_container">
		                    <h3 class="bbb_viewed_title">BÁNH MỲ</h3>
		                    <div class="bbb_viewed_nav_container">
		                        <div class="bbb_viewed_nav ccc_viewed_prev"><i class="fas fa-chevron-left"></i></div>
		                        <div class="bbb_viewed_nav ccc_viewed_next"><i class="fas fa-chevron-right"></i></div>
		                    </div>
		                </div>
		                <div class="bbb_viewed_slider_container">
		                    <div class="owl-carousel owl-theme ccc_viewed_slider owl-loaded owl-drag">  
		                        <div class="owl-stage-outer">
		                        	<div class="owl-stage" style="transform: translate3d(-1813px, 0px, 0px); transition: all 0s ease 0s; width: 3108px;">

		                        		<!--(Lặp nhiều 1 chút, t để 1 sp nó chạy full không sao, cứ đổ vô là nó chạy lần lượt, phía cuối nó có 1 khoảng trống thì kệ nó, không ai quan tâm đâu)		
		                        		-->

		                        		<?php
											$loaicakes = loai_cakes(3);
											foreach($loaicakes as $lc):
												$pt = 100 - (($lc["GiaGiam"]*100)/$lc["GiaGoc"]);
                								$pt = round($pt, 0, PHP_ROUND_HALF_UP);
										?>
		                        		<!-- Lặp -->
		                        		<div class="owl-item sp" >
			                            	<div class="owl-item">
			                                    <div class="bbb_viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
			                                        <div class="bbb_viewed_image"><img src="public/img/cakes/<?php echo $lc["Anh"]; ?>" alt=""></div>
			                                        <div class="bbb_viewed_content text-center">
			                                            <div class="bbb_viewed_price"><?php echo number_format($lc["GiaGiam"], 0, ",", "."); ?><sup> đ</sup></div>
			                                            <div class="bbb_viewed_name"><a href="./?p=cake&idCake=<?php echo $lc["idCake"]; ?>&name=<?php echo $lc["TenKD"]; ?>"><?php echo $lc["TenBanh"]; ?></a></div>
			                                        </div>
			                                        <ul class="item_marks">
														<li class="item_mark item_new">-<?php echo $pt; ?>%</li>
			                                        </ul>
			                                    </div>
			                                </div>
			                            </div>
			                            <!-- Lặp -->
										<?php
											endforeach;
										?>
		                    		</div>
		                		</div>
		                    	<div class="owl-nav disabled">
		                    		<div class="owl-prev">prev</div>
		                    		<div class="owl-next">next</div>
			                    </div>
		                	</div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
    </div>
    <!-- =======================Lặp ở trên===================== -->
    <!-- don't care -->
    <div style="display: none;">
		<section class="contentProducts"></section>
	</div>
</div>