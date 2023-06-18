<template>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon">
            <!-- <img :src="notification.icon"> -->
            <i :class="notification.icon"></i>
        </div>
        <a @click.prevent="markAsRead" title="View notification" :href="notification.action_url" data-8xload>
            <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                    {{notification.title}}
                </div>
                <div class="kt-notification__item-time">
                    {{notification.created}}
                </div>
            </div>
        </a>
    </a>
</template>

<script>
export default {
  props: {
    notification: {
      type: Object,
      required: true
    }
  },

  methods: {
    markAsRead () {
      this.$emit('read')
    }
  }
}
</script>
