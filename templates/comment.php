<div class="row">
    <!-- comment product -->
    <div class="comment">
        <div class="comment-title">
            <h2>Bình luận</h2>  
        </div>
        <!-- comment list -->
        <div class="comment-list">
            
                <?php
                require_once(__DIR__ . './../templates/comment-list.php');
                ?>
            </div>
        </div>
        <!-- end comment list -->
        <div class="comment-content">
            <!-- add comment -->
            <div class="add_comment">
                <div class="add_comment-title">
                    <p>Thêm bình luận</p>
                </div>
                <div class="add_comment-content">
                    <form action="" method="POST" id="add_comment">
                        <!-- aria comment -->
                        <input type="hidden" name="maKhachHang" id="maKhachHang" value="<?php echo $_COOKIE['maKhachHang']; ?>">
                        <input type="text" name="comment" id="comment" placeholder="Nhập bình luận" required/>
                        <button type="submit" name="submit" class="btn_comment">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>