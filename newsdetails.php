<?php
include 'includes/header.php';

if (!isset($_GET['newid']) || $_GET['newid'] == NULL) {
	echo "<script>window.location ='404.php'</script>";
} else {
	$id = $_GET['newid'];
}
?>

<!-- MAIN -->
<main class="site-main blog-single">
        <div class="container">
            <ol class="breadcrumb-page">
                <li><a href="index-2.html">Trang chủ </a></li>
                <li class="active"><a href="#">Chi tiết bài viết</a></li>
            </ol>
        </div>
        <div class="container">
            <div class="row">
                <?php 
                    $get_new = $new->getnewbyId($id);
                    if ($get_new) {
                        while ($result_details = $get_new->fetch_assoc()) {
                
                
                ?>
                <div class="col-md-9 col-sm-8 ">
                    <div class="main-content">
                        <div class="post-detail">
                            <div class="post-item">
                                <div class="post-thumb">
                                    <a href="#"><img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="post-image"></a>
                                    <span class="date">22<span>Dec</span></span>
                                </div>
                                <div class="post-item-info">
                                    <h3 class="post-name"><a href="#"><?php echo $result_details['title'] ?></a></h3>
                                    <!-- <div class="post-metas">
                                        <span class="author">Post by: <span>Admin</span></span>
                                        <span class="comment"><i class="fa fa-comment" aria-hidden="true"></i>3 Comments</span>
                                    </div> -->
                                    <div class="post-content">
                                        <p><?php echo $result_details['body'] ?></p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="post-comments">
                            <div class="block-title">Comment Face</div>
                            <!-- <p>Your email address will not be published. Required fields are marked *</p>
                            <div class="block-content">
                                <form>
                                    <div class="form-group col-md-6 padding-left">
                                        <label class="title">Name*</label>
                                        <input title="name" type="text" class="form-control" id="forName">
                                    </div>
                                    <div class="form-group col-md-6 padding-right">
                                        <label class="title">Email*</label>
                                        <input title="email" type="email" class="form-control" id="forEmail">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Website</label>
                                        <input title="web" type="text" class="form-control" id="forWebsite">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Comment</label>
                                        <textarea title="comment" class="form-control" id="forContent" rows="9"></textarea>
                                    </div>
                                    <button type="submit" class="btn-comment">Post Comment</button>
                                </form>
                            </div> -->
                        </div>
                    </div>
                </div>
                <?php }} ?>
                <div class="col-md-3 col-sm-4">
                    <div class="sidebar-left">
                        <div class="block-search-blog">
                            <form class="searchform">
                                <div class="control">
                                    <input type="text" placeholder="Enter Keywords..." name="text"
                                           class="input-subscribe">
                                    <button type="submit" class="btn-searchform"><i class="flaticon-magnifying-glass"
                                                                                    aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="block-recent-post-blog">
                            <div class="block-title">Bài viết mới nhất</div>
                            <ul>
                                <?php 
                                    $news = $new->show_new();
                                    foreach ($news as $key => $value) {
                                ?>
                           
                                <li class="recent-post-item"><a href="newsdetails.php?newid=<?php echo $value['newId'] ?>"><?php echo $fm->textShorten($value['title'], 60) ?></a></li>

                                <?php } ?>
                                
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