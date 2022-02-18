<table class="table table-horvered table-striped table-bordered" id="datatable" width="100%">
	<thead class="bg-gray">
		<tr>
			<td>Tanggal</td>
			<td>Tooling Category</td>
			<td>Process Name</td>
			<td>Jenis Proses</td>
			<td>Jenis Tool</td>
			<td>Aset No</td>
			<td>Part Name</td>
			<td>Part No</td>
			<td>Cav</td>
			<td>Maker</td>
			<td>Perioder (Month)</td>
			<td>Order Status</td>
			<td>Status Tooling</td>
			<td>Status Data</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $key): ?>
			<tr>
				<td><?=$key->reg_date?></td>
				<td><?=$key->tool_kategori?></td>
				<td><?=$key->prosesname?></td>
				<td><?=$key->jenisproses?></td>
				<td><?=$key->jenistool?></td>
				<td><?=$key->asetno?></td>
				<td><?=$key->partname?></td>
				<td><?=$key->partno?></td>
				<td><?=$key->cav?></td>
				<td><?=$key->maker?></td>
				<td><?=$key->periode?></td>
				<td><?=$key->OrderStatus?></td>
				<td><?=$key->StatusTooling?></td>
				<td><?=$key->status?></td>
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
            order: [[0, 'desc']],
            "responsive": true,  
              
          } ); 
	});
</script>