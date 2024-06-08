<div class="flex flex-center relative flex-col gap-8">
    <h3 class="text-xl font-semibold text-main">Sistem Pendukung Keputusan Bantuan Sosial</h3>
    <div class=" flex flex-end flex-col gap-2 ">
        <table class="table-parent-spk-statistic">
            <thead>
                <tr>
                    <th class="priority-column">Prioritas</th>
                    <th class="name-column">Nama</th>
                    <th>No. Telepon</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5 && $i < count($results); $i++)
                <tr class="hover:bg-fourth transition-all ease-linear">
                    <td class="priority-column">{{ $i + 1 }}</td>
                    <td class="name-column">{{ $results[$i]['name'] }}</td>
                    <td>{{ $results[$i]['nomor_hp'] }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
