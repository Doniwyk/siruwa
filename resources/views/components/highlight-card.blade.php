<div class="news">
    <img src="{{ $newsData->url_gambar }}" alt="img" class="h-full min-w-[8.5rem] object-cover rounded-2xl sm:mr-3 md:mr-5">
    <div class="w-full">
        <span for="" class="text-xs text-gray-400">{{ date('F, j Y', strtotime($newsData->tanggal ? $newsData->tanggal : $newsData->created_at)) }}</span>
       <div id="paragraf" class="preview-paragraf">
           {!! html_entity_decode($newsData->isi)!!}
        </div> 
    </div>
</div>