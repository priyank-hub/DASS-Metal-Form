<template>
  <div>
    <div v-if="$page.props.flash && $page.props.flash.success && show" class="flash-success">
      <p class="success m-0" v-html="$page.props.flash.success" />
    </div>
    <div v-else-if="$page.props.flash && $page.props.flash.error && show" class="flash-error">
      <p class="error m-0" v-html="$page.props.flash.error" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      timeout: null,
      ttl: 5,
      show: true,
    }
  },
  watch: {
    '$page.props.flash': {
      handler() {
        this.show = true

        // this.ttl = this.$page.flash.ttl ?? this.ttl

        this.flash()
      },
      deep: true,
      immediate: true,
    },
  },
  methods: {
    flash() {
      clearTimeout(this.timeout)

      // this.timeout = null

      this.timeout = setTimeout(() => {
        this.show = false
      }, this.ttl * 1000)
    },
  },
}
</script>
<style scoped>
.flash-success {
  width: 200px;
  background-color: rgb(103, 180, 103);
  color: rgb(33, 95, 33);
  border: 1px solid rgb(33, 95, 33);
  padding: 20px;
  border-radius: 10px;
  font-size: 15px;

  position: absolute;
  bottom: 20px;
  right: 0;
}

.flash-error {
  width: 300px;
  background-color: rgb(180, 103, 103);
  color: rgb(95, 37, 33);
  border: 1px solid rgb(95, 37, 33);
  padding: 20px;
  border-radius: 10px;
  font-size: 15px;

  position: absolute;
  bottom: 20px;
  right: 0;
}
</style>