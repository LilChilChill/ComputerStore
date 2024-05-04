
</main>
<footer class="site-footer footer-opt-2" style="margin-top: 40px;">
        <?php
            $get_setting = $setting->getSetting();
            if($get_setting){
                while($result = $get_setting->fetch_assoc()){
                
            ?>
        <div class="footer-column equal-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 equal-elem">
                        <div class="logo-footer">
                            <img src="admin/uploads/<?php echo $result['logo'] ?>" style="width: 100px;margin:0px" alt="logo">
                        </div>
                        <div class="contacts">
                            <h2 class="text-white mb-4 text-3xl"><?php echo $result['title'] ?></h2>
                            <p class="contacts-info"><?php echo $result['description'] ?></p>
                            <span class="contacts-info info-address "><?php echo $result['address'] ?></span>
                            <span class="contacts-info info-phone"><?php echo $result['phone'] ?></span>
                            <span class="contacts-info info-support"><?php echo $result['email'] ?></span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 equal-elem">
                        <div class="links">
                            <h3 class="title-of-section">Liên kết</h3>
                            <ul>
                                <li><a href="login.php">Đăng nhâp</a></li>
                                <li><a href="cart.php">Xem giỏ hàng</a></li>
                                <li><a href="wishlist.php">Sản phẩm yêu thích</a></li>
                                <li><a href="products.php">Sản phẩm</a></li>
                                <li><a href="news.php">Bài viết</a></li>
                                <li><a href="contact.php">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                   
                    <div class="col-md-4 col-sm-6 equal-elem">
                        <div class="links">
                            <h3 class="title-of-section">Đăng ký nhận khuyến mãi</h3>
                            <span class="span-newsletter">Nhận thông báo về sản phẩm mới, bản phát hành giới hạn và hơn thế nữa.</span>
                            <div class="newsletter-form">
                                <form id="newsletter-validate-detail" class="form subscribe">
                                    <div class="control">
                                        <input type="email" placeholder="Enter your email" id="newsletter" name="email"
                                               class="input-subscribe">
                                        <button type="submit" title="Subscribe" class="btn subscribe">
                                            <span>Sign Up</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="socials">
                                <a href="<?php echo $result['link_twitter'] ?>" class="social"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="<?php echo $result['link_facebook'] ?>" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="<?php echo $result['link_youtobe'] ?>" class="social"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                <a href="<?php echo $result['link_instagram'] ?>" class="social"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } } ?>
        <!-- <div class="copyright full-width">
            <div class="container">
                <div class="copyright-right">
                    © Copyright 2020<span> Dagon</span>. All Rights Reserved.
                </div>
                <div class="pay-men">
                    <a href="#"><img src="assets/images/general/pay1.jpg" alt="pay1"></a>
                    <a href="#"><img src="assets/images/general/pay2.jpg" alt="pay2"></a>
                    <a href="#"><img src="assets/images/general/pay3.jpg" alt="pay3"></a>
                    <a href="#"><img src="assets/images/general/pay4.jpg" alt="pay4"></a>
                </div>
            </div>
        </div> -->
    </footer>
    <!-- end FOOTER -->
</div>
<a href="#" id="scrollup" title="Scroll to Top">Scroll</a>

</body>

<!-- Mirrored from ledthanhdat.vn/html/dagon/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Aug 2022 00:56:03 GMT -->
</html>