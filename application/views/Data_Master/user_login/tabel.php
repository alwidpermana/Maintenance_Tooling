<table class="table table-horvered table-striped table-bordered" id="datatable" width="100%">
	<thead class="bg-gray">
		<tr>
			<td>NIK</td>
			<td>Nama</td>
			<td>Jenis Kelamin</td>
			<td>Jabatan</td>
			<td>Departemen</td>
			<td>Divisi</td>
			<td>Seksi</td>
			<td>Status</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $key): ?>
			<tr>
				<td><?=$key->NIK?></td>
				<td><?=$key->namapeg?></td>
				<td><?=$key->jkelamin?></td>
				<td><?=$key->jabatan?></td>
				<td><?=$key->departemen?></td>
				<td><?=$key->divisi?></td>
				<td><?=$key->seksi?></td>
				<td>
					<select class="form-control" id="editStatusAktif" nik = "<?=$key->NIK?>">
                        <option value="AKTIF" <?=$key->STATUS=='AKTIF'?'selected':''?>>Aktif</option>
                        <option value="TIDAK AKTIF" <?=$key->STATUS=='TIDAK AKTIF'?'selected':''?>>Tidak Aktif</option>
                    </select>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#datatable').DataTable( {
            scrollY:        "400px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         true,
            'searching': false,
            columnDefs: [
                { orderable: false, targets: 7 }
            ],
            order: [[1, 'asc']]  
              
          } ); 
	});
</script>