<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                /* translators: 1: number of comments, 2: post title */
                printf(
                    /* Use esc_html or wp_kses_post depending on allowed tags; here we allow <span> inside title */
                    wp_kses_post(
                        _nx(
                            'One thought on &ldquo;%2$s&rdquo;',
                            '%1$s thoughts on &ldquo;%2$s&rdquo;',
                            get_comments_number(),
                            'comments title',
                            'elica-bootstrap'
                        )
                    ),
                    esc_html( number_format_i18n( get_comments_number() ) ),
                    '<span>' . esc_html( get_the_title() ) . '</span>'
                );
            ?>
        </h2>
        <ol class="comment-list">
            <?php
                wp_list_comments(
                    array(
                        'style'       => 'ol',
                        'short_ping'  => true,
                        'avatar_size' => 50,
                    )
                );
            ?>
        </ol>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="comment-navigation" role="navigation">
                <div class="nav-previous"><?php previous_comments_link( esc_html__( '← Older Comments', 'elica-bootstrap' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments →', 'elica-bootstrap' ) ); ?></div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
    <?php
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'elica-bootstrap' ); ?></p>
    <?php endif; ?>
    <?php comment_form(); ?>
</div>
