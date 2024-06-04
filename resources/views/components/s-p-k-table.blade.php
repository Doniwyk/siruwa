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
                @foreach ($results as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result['name'] }}</td>
                    <td>{{ $result['combined_score'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="w-32 py-2 rounded-2xl bg-main font-semibold text-white" name="action">Detail</button>
    </div>
</div>
