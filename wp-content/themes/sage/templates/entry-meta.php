<p class="byline author vcard">
  <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="avatar">
    <?= get_avatar(get_the_author_meta('ID'), 36); ?>
  </a>
  <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="nickname">
    <?= the_author_meta('nickname'); ?>
  </a>
  |
  <time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
  <?php if(get_comments_number()): ?>
    |
    <span class="comment-count">
      <?= get_comments_number(); ?> comments
    </span>    
  <?php endif; ?>
</p>
