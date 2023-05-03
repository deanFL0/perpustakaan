{{-- <form action="{{ route('program.print') }}" method="GET">
    @csrf
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="year" class="form-control" onchange="pilihSemester()">
                        <option value="" hidden>Pilih Tahun</option>
                        <?php
                        foreach ($years as $year) {
                            // echo '<option value="' . $year->year . 'S1' . '">' . $year->year . ' Semester 1 ' . '</option>';
                            // echo '<option value="' . $year->year . 'S2' . '">' . $year->year . ' Semester 2 ' . '</option>';

                            echo '<option value="' . $year->year . '">' . $year->year . '</option>';
                        }
                        ?>
                    </select>
                    <select name="semester" class="form-control">
                        <option value="" hidden>Pilih Semester</option>
                        <option id="semester1" value="S1" hidden>Semester 1</option>
                        <option id="semester2" value="S2" hidden>Semester 2</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
</form>
@push('js')
    <script>
        function pilihSemester() {
            const semester1 = document.getElementById('semester1');
            const semester2 = document.getElementById('semester2');
            //get year value from controller with php
            const year = <?php echo json_encode($waktu_kegiatan); ?>;
            //log year
            console.log(year);
            //if year contain month 1-6 then unhide semester 1
            if (year.includes(document.getElementsByName('year')[0].value + 'S1')) {
                semester1.hidden = false;
            } else {
                semester1.hidden = true;
            }
            //if year contain month 7-12 then unhide semester 2
            if (year.includes(document.getElementsByName('year')[0].value + 'S2')) {
                semester2.hidden = false;
            } else {
                semester2.hidden = true;
            }
        }
    </script>
@endpush --}}
