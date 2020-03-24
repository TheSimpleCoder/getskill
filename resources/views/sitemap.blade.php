<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">    
    @foreach ($courses as $post)
        <url>
            <loc>{{ route('course_page_info', [app()->getLocale(), $post->id]) }}</loc>
            <changefreq>monthly</changefreq>
        </url>
    @endforeach
</urlset>