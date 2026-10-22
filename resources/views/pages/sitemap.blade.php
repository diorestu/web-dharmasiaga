<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($pages as $page)
    <url><loc>{{ $page['url'] }}</loc></url>
@endforeach
</urlset>
