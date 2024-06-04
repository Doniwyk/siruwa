<div class="flex flex-center relative flex-col gap-8">
    <h3 class="text-xl font-semibold text-main">Sistem Pendukung Keputusan Bantuan Sosial</h3>
    <div class="flex flex-end flex-col gap-2 ">
        <table class="table-parent-spk-statistic">
            <thead>
                <tr>
                    <th>Prioritas</th>
                    <th>Nama</th>
                    <th>No.Telepon</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5 && $i < count($results); $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $results[$i]['name'] }}</td>
                    <td>{{ $results[$i]['combined_score'] }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
        <a href="{{ route('admin.statistic.bansos') }}">
            <button type="submit" class="w-32 py-2 rounded-2xl bg-main font-semibold text-white" name="action">Detail</button>
        </a>
    </div>
</div>
