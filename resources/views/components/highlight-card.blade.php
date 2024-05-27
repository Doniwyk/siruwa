<div class="news flex gap-5 ">
    <img src="{{ $newsData->url_gambar }}" alt="img" class="h-full min-w-[8.5rem] object-contain rounded-2xl">
    <div class="w-full">
        <span for="" class="text-xs text-gray-400">{{ date('F, j Y', strtotime($newsData->tanggal ? $newsData->tanggal : $newsData->created_at)) }}</span>
        {!! html_entity_decode($newsData->isi)!!}
    </div>
</div>