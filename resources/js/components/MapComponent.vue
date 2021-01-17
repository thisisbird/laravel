<template>
    <div class="row no-gutters">
      <!-- 選擇所在區域 -->
  <select id="cityName" class="form-control" v-model="select.city">
    <option value="">請選擇縣市</option>
    <option :value="c.CityName" v-for="c in cityName" :key="c.CityName">
      {{ c.CityName }}
    </option>
  </select>

  <select id="area" class="form-control" v-model="select.area">
    <option value="">請選擇地區</option>
    <option :value="a.AreaName" v-for="a in cityName.find((city) => city.CityName === select.city).AreaList" :key="a.AreaName">
      {{ a.AreaName }}
    </option>
  </select>

      <!-- 顯示藥局位置 -->
      <div class="col-sm-9">
        <div id="map"></div>
      </div>
    </div>
</template>
<script>
// 導入內部檔案
import cityName from './cityName.json';
export default {
  name: 'App',
  // 製作元件
  data: () => ({
    cityName,
    // select 先暫時設定為空物件1
    select: {
        city: '臺北市',
        area: '中正區',
    },
  }),
  // ...
   components: {
  },
  mounted() {
    const api = 'https://raw.githubusercontent.com/kiang/pharmacies/master/json/points.json';
     this.$http.get(api).then((response) => {
      // 將結果印出來看看
      console.log(response);
    });
  },
};
</script>
