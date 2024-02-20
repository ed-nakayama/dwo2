<?php if($paginator->hasPages()): ?>
    <nav>
        <ul class="pagerList" >
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                    <span aria-hidden="true"><span class="material-icons">&lt;&lt;前ページ</span></span>
                </li>
            <?php else: ?>
                <li class="page__btn">
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>"><span class="material-icons">&lt;&lt;前ページ</span></a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li  class="page__dots"><span><?php echo e($element); ?></span></li>
                <?php endif; ?>
                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="page__numbers active"><span><font color="red"><b><?php echo e($page); ?></b></font></span></li>
                        <?php else: ?>
                            <li class="page__numbers"><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page__btn">
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>"><span class="material-icons">次ページ&gt;&gt;</span></a>
                </li>
            <?php else: ?>
                <li class="disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                    <span aria-hidden="true"><span class="material-icons">次ページ&gt;&gt;</span></span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/vendor/pagination/admin.blade.php ENDPATH**/ ?>