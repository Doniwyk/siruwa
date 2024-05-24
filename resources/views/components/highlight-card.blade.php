<div class="news flex gap-5 ">
    <img src="{{ $newsData->url_gambar }}" alt="img" class="h-full object-cover rounded-2xl">
    <div class="">
        <span for="" class="text-xs text-gray-400">{{ date('F, j Y', strtotime($newsData->tanggal ? $newsData->tanggal : $newsData->created_at)) }}</span>
        <p class="desc-news">{{ $newsData->isi }}</p>
    </div>
</div>