<?php
include 'includes/header.php';
?>



 <!-- MAIN -->
 <main class="site-main blog-grid">
        <div class="container">
            <ol class="breadcrumb-page">
                <li><a href="index-2.html">Trang chủ </a></li>
                <li class="active"><a href="#">Bài viết mới</a></li>
            </ol>
        </div>
        <div class="container">
            <div class="row">
                <div class="float-none float-right">
                    <div class="main-content">
                        <div class="post-grid post-items">
                            <?php 
                                $news = $new->show_new();
                                foreach ($news as $key => $value) {
                            ?>
                           
                            <div class="post-grid-item col-md-6">
                                <div class="post-item">
                                    <div class="post-thumb">
                                        <a href="newsdetails.php?newid=<?php echo $value['newId'] ?>"><img class="h-[40rem] w-full object-cover" src="admin/uploads/<?php echo $value['image'] ?>" alt="post-image"></a>
                                        <span class="date">22<span>Dec</span></span>
                                    </div>
                                    <div class="post-item-info">
                                        <h3 class="post-name"><a href="newsdetails.php?newid=<?php echo $value['newId'] ?>"><?php echo $fm->textShorten($value['title'], 150) ?></a>
                                        </h3>
                                        <div class="post-metas">
                                            <span class="author">Người đăng: <span>Admin</span></span>
                                            <!-- <span class="comment"><i class="fa fa-comment" aria-hidden="true"></i>6 Comments</span> -->
                                        </div>
                                        <div class="post-content">
                                            <p><?php echo $fm->textShorten($value['description'], 150) ?></p>
                                            <a href="newsdetails.php?newid=<?php echo $value['newId'] ?>" class="read-more">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?> 
                        </div>
                        <div class="post-grid pagination">
                            <ul class="nav-links">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li class="back-next"><a href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- end MAIN -->


<?php
include 'includes/footer.php';
?>