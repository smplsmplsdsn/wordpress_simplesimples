<ul class="sns-list post__sns-list">
  <?php if (isset($post_cf_github) && $post_cf_github !== ""): ?>
  <li><a class="sns-github" href="<?php echo $post_cf_github; ?>"><span class="icon-github"></span></a></li>
  <?php endif; ?>
  <li><a class="sns-twitter" href="<?php echo $sns_link_twitter; ?>"><span class="icon-twitter"></span></a></li>
  <li><a class="sns-facebook" href="<?php echo $sns_link_facebook; ?>"><span class="icon-facebook"></span></a></li>
  <li><a class="sns-line" href="<?php echo $sns_link_line; ?>"><span class="icon-line"></span></a></li>
</ul>