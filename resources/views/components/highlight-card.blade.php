<div class="news">
    <div class="animate-pulse min-w-[8.2rem] h-20 bg-slate-500 rounded-2xl  sm:mr-3 md:mr-5">
        <img src="{{ $newsData->url_gambar }}" alt="img" class="h-full w-full object-cover rounded-2xl">
    </div>
    <div class="w-full">
        <span for="" class="text-xs text-gray-400">{{ date('F, j Y', strtotime($newsData->tanggal ? $newsData->tanggal : $newsData->created_at)) }}</span>
       <div id="paragraf" class="preview-paragraf">
           {!! html_entity_decode($newsData->isi)!!}
        </div> 
    </div>
</div>