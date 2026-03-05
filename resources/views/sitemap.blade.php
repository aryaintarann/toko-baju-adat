{!! $xmlHeader !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Pages --}}
    @foreach ($staticUrls as $url)
        <url>
            <loc>{{ $url }}</loc>
            <lastmod>{{ now()->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Dynamic Product Pages --}}
    @foreach ($products as $product)
        <url>
            <loc>{{ route('catalog.show', ['slug' => $product->slug]) }}</loc>
            <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>