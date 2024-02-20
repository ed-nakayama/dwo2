<?php if($paginator->hasPages()): ?>
    <nav>
        <ul class="pagerList">
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                    <span aria-hidden="true"><span class="material-icons">&lt;前へ</span></span>
                </li>
            <?php else: ?>
                <li class="page__btn">
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>"><span class="material-icons">&lt;前へ</span></a>
                </li>
            <?php endif; ?>

			<li  class="page__dots"><span><?php echo e($paginator->currentPage()); ?>/<?php echo e($paginator->lastPage()); ?></span></li>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page__btn">
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>"><span class="material-icons">次へ&gt;</span></a>
                </li>
            <?php else: ?>
                <li class="disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                    <span aria-hidden="true"><span class="material-icons">次へ&gt;</span></span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/vendor/pagination/user.blade.php ENDPATH**/ ?>