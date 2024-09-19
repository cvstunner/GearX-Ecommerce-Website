<div class="row">
  <?php foreach ($products as $product): ?>
    <div class="col-md-3 col-sm-6 mt-2 mb-4" style="aspect-ratio: 3/4">
      <div class="product-grid shadow w-100 h-100 d-flex flex-column border-1 rounded-1 overflow-hidden">
        <div class="product-image w-100 h-auto" style="aspect-ratio: 1/7">
          <a href="product/slug=<?php echo $product->slug ?>" class="image d-flex">
            <?php if (empty($product->picture)): ?>
              <img class="w-100 h-100 object-cover-fit" src="admin/uploads/default.png" alt="" />
            <?php else: ?>
              <img class="w-100 h-100 object-cover-fit" src="<?php echo IMAGES ?>product/<?php echo $product->picture; ?>" alt="" />
            <?php endif; ?>
          </a>
          <span class="product-discount-label">-23%</span>
          <ul class="product-links overflow-hidden" style="border-radius: 2px">
            <li class="bg-white"><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a></li>
            <li class="bg-white"><a href="#"><i class="fa fa-heart"></i></a></li>
            <li class="bg-white"><a href="#"><i class="fa fa-random"></i></a></li>
          </ul>
          <a href="#" class="add-to-cart">Add to Cart</a>
        </div>
        <div class="product-content shadow-none w-100 h-100 flex-grow d-flex flex-column justify-content-center">
          <h5>★★★★☆</h5>
          <h3 class="title"><a href="#"><?php echo $product->name; ?></a></h3>
          <div class="price fs-5">₹<?php echo $product->price; ?><span class="ms-1 fs-6"><span class="ms-1 fs-6">₹<?php echo $product->mrp ?></span></div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
