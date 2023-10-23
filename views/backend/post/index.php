<?php
use App\Models\Post;
$list = Post::where('status','!=',0)->orderBy('Created_at','DESC')->get();
?>
<?php require_once "../views/backend/header.php";?>      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả bài viết</h1>
                     <a href="post_create.html" class="btn btn-sm btn-primary">Thêm bài viết</a>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header p-2">
                  Noi dung
               </div>
               <div class="card-body p-2">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th class="text-center" style="width:30px;">
                              <input type="checkbox">
                           </th>
                           <th class="text-center" style="width:130px;">Hình ảnh</th>
                           <th>Tiêu đề bài viết</th>
                           <th>Tên danh mục</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php if(count($list) > 0) : ?>
                              <?php foreach($list as $item  ):?>
                        <tr class="datarow">
                           <td>
                              <input type="checkbox">
                           </td>
                           <td>
                              <img src="../public/images/<?= $item->image; ?>" alt="<?= $item->image; ?>">
                           </td>
                           <td>
                              <div class="name">
                              <?= $item->title ; ?> 
                              </div>
                              <div class="function_style">
                                       <?php if($item->status==1):?>
                                       <a href="index.php?option=post&cat=status
                                       &id=<?= $item->id; ?>" class="btn btn-success btn-xs">
                                       <i class="fas fa-toggle-on"></i> Hiện</a>
                                       <?php else:?>
                                          <a href="index.php?option=post&cat=status
                                          &id=<?= $item->id; ?>" class="btn btn-danger btn-xs">
                                          <i class="fas fa-toggle-off"></i>Ẩn</a>
                                          <?php endif;?>
                                       <a href="index.php?option=post&cat=edit&id=<?= $item->id; ?>" class="btn btn-primary btn-xs">
                                       <i class="fas fa-edit"></i> Chỉnh sửa
                                    </a>
                                       <a href="index.php?option=post&cat=show&id=<?= $item->id; ?>" class="btn btn-info btn-xs">
                                       <i class="fas fa-eye"></i> Chi tiết
                                    </a>
                                       <a href="index.php?option=post&cat=delete&id=<?= $item->id; ?>" class="btn btn-danger btn-xs">
                                       <i class="fas fa-trash"></i>Xoá
                                    </a>
                                    </div>
                           </td>
                           <td><?= $item->slug; ?> </td>
                        </tr>
                        <?php endforeach;?>
                              <?php endif;?>
                     </tbody>
                  </table>
               </div>
            </div>
         </section>
      </div>
      <!-- END CONTENT-->
      <?php require_once '../views/backend/footer.php'; ?>