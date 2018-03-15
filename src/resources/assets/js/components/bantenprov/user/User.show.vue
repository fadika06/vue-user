<template>
  <div>

    <div class="card mb-3">
      <div class="card-header">Grafik User</div>
      <div class="card-body">
        <echarts-user></echarts-user>
      </div><!-- /.card-body -->
    </div><!-- /.card -->

    <div class="row">
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-header">Grafik Kota</div>
          <div class="card-body">
            <echarts-user-kota></echarts-user-kota>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-header">Grafik Tahunan</div>
          <div class="card-body">
            <echarts-user-tahun></echarts-user-tahun>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div>
    </div>

  </div>
</template>
