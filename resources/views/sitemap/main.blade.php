<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		@foreach($urls as $url)
		<url>
			<loc>{{ $url }}</loc>
		</url>
		@endforeach
	</urlset>
    <sitemap>
        <loc>{{ route('sitemap-news') }}</loc>
        <lastmod>{{ date('c', time()) }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap-products') }}</loc>
        <lastmod>{{ date('c', time()) }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap-categories') }}</loc>
        <lastmod>{{ date('c', time()) }}</lastmod>
    </sitemap>
</sitemapindex>