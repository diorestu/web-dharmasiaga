<div class="membership-loan-table mb-4">
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border: 1px solid {{ $table['border_color'] ?? '#d0d7de' }} !important;">
        <div class="text-center py-3 text-white fw-bold" style="background-color: {{ $table['header_bg'] ?? '#0b3b7a' }}; font-size: 1.15rem; letter-spacing: 0.5px;">
            {{ $table['title'] }}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0 align-middle text-center bg-white" style="border-color: {{ $table['border_color'] ?? '#dee2e6' }};">
                <thead style="background-color: {{ $table['thead_bg'] ?? '#f8f9fa' }}; color: {{ isset($table['thead_bg']) ? '#ffffff' : '#212529' }};">
                    <tr>
                        @foreach($table['headers'] as $header)
                            <th scope="col" class="py-3 fw-bold" style="border-color: {{ $table['border_color'] ?? '#dee2e6' }};">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($table['rows'] as $row)
                        <tr style="background-color: {{ $loop->iteration % 2 === 0 ? '#fdf8f8' : '#ffffff' }};">
                            @foreach($row as $cell)
                                <td class="py-2 fw-bold" style="color: #212529; border-color: {{ $table['border_color'] ?? '#dee2e6' }};">{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
