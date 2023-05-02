<form action="{{ route('program.print') }}" method="GET">
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
                    <select name="year" class="form-control">
                        <option value="" hidden>Pilih Tahun</option>
                        <?php
                        foreach ($years as $year) {
                            echo '<option value="' . $year->year . '">' . $year->year . '</option>';
                        }
                        ?>
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
