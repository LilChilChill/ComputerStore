

 <div class="block-section-1">
	<div class="main-slide slide-opt-1 full-width">
		<div class="owl-carousel nav-style1" data-nav="false" data-autoplay="false" data-dots="true"
			data-loop="true" data-margin="0"
			data-responsive='{"0":{"items":1},"600":{"items":1},"1000":{"items":1}}'>
			<?php
				$get_slider = $product->show_slider();
				foreach($get_slider as $key=> $val){
					?>
					<div class="item-slide item-slide-<?php echo $key+1 ?>" style="background-image: url(admin/uploads/<?php echo $val['slider_image'] ?>)">
						
					</div>
						
				<?php
				}
			?>
		</div>
	</div>
</div>