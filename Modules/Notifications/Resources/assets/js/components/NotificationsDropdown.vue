<template>
    <!--begin: Notifications -->
    <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
            <span class="kt-header__topbar-icon  kt-pulse kt-pulse--warning">
                <i :data-count="total" class="fa fa-bell" :class="{ 'hide-count': !hasUnread }"></i>
                <span class="kt-pulse__ring"></span>
            </span>
            <span class="kt-badge kt-badge--danger noti-badge">{{ total }}</span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
            <form>
                <!--begin: Head -->
                <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" v-bind:style="{backgroundImage: 'url(' + baseUrl + '/8x/assets/media/misc/bg-1.jpg' + ')'}">
                    <h3 class="kt-head__title">
                        {{ total }} Notification(s)
                        &nbsp;
                        <span v-show="hasUnread" class="btn btn-success btn-sm btn-bold btn-font-md"><a href="#" style="color: inherit;" @click.prevent="markAllRead">Mark all as read</a></span>

                      <!-- Enable/Disable push notifications -->
                      <button
                        @click="togglePush"
                        :disabled="pushButtonDisabled || loading"
                        type="button" class="btn btn-primary"
                        :class="{ 'btn-primary': !isPushEnabled, 'btn-danger': isPushEnabled }">
                        {{ isPushEnabled ? 'Disable' : 'Enable' }} Push Notifications
                      </button>
                    </h3>
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Notifications</a>
                        </li>
                        <li class="nav-item kt-hidden">
                            <a class="nav-link" data-toggle="tab" href="#topbar_notifications_follow_ups" role="tab" aria-selected="false">Follow-up(s)</a>
                        </li>
                        <li class="nav-item kt-hidden">
                            <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs" role="tab" aria-selected="false">Logs</a>
                        </li>
                    </ul>
                </div>

                <!--end: Head -->
                <div class="tab-content">
                    <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                            <notification v-for="notification in notifications"
                                :key="notification.id"
                                :notification="notification"
                                v-on:read="markAsRead(notification)"
                            ></notification>
                            <a v-if="hasUnread" href="#" class="kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <i class="fas fa-glasses"></i>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                        <a href="#" @click.prevent="fetchAll(null)">View all</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="topbar_notifications_follow_ups" role="tabpanel">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                            <notification v-for="notification in notifications"
                                :key="notification.id"
                                :notification="notification"
                                v-on:read="markAsRead(notification)"
                            ></notification>
                            <a v-if="hasUnread" href="#" class="kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <i class="fas fa-glasses"></i>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                        <a href="#" @click.prevent="fetchAll(null)">View all</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane kt-hidden" id="topbar_notifications_logs" role="tabpanel">
                        <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                            <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                    All caught up!
                                    <br>No new notifications.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end: Notifications -->
</template>

<script>
import $ from 'jquery'
import axios from 'axios'
import Notification from './Notification'

export default {
  components: { Notification },

  data: () => ({
    total: 0,
    notifications: [],
    baseUrl: window.Laravel.baseUrl,
    asidePath:window.Laravel.notification_base,
    loading: false,
    isPushEnabled: false,
    pushButtonDisabled: true
  }),

  mounted () {
    this.registerServiceWorker()

    this.fetch()

    if (window.Echo) {
      this.listen()
    }
  },

  computed: {
    hasUnread () {
      return this.total > 0
    }
  },

  methods: {
    /**
     * Register the service worker.
     */
    registerServiceWorker () {
      if (!('serviceWorker' in navigator)) {
        console.log('Service workers aren\'t supported in this browser.')
        return
      }

      navigator.serviceWorker.register('/sw.js')
        .then(() => this.initialiseServiceWorker())
    },

    initialiseServiceWorker () {
      if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
        console.log('Notifications aren\'t supported.')
        return
      }

      if (Notification.permission === 'denied') {
        console.log('The user has blocked notifications.')
        return
      }

      if (!('PushManager' in window)) {
        console.log('Push messaging isn\'t supported.')
        return
      }

      navigator.serviceWorker.ready.then(registration => {
        registration.pushManager.getSubscription()
          .then(subscription => {
            this.pushButtonDisabled = false

            if (!subscription) {
              return
            }

            this.updateSubscription(subscription)

            this.isPushEnabled = true
          })
          .catch(e => {
            console.log('Error during getSubscription()', e)
          })
      })
    },

    /**
     * Subscribe for push notifications.
     */
    subscribe () {
      navigator.serviceWorker.ready.then(registration => {
        const options = { userVisibleOnly: true }
        const vapidPublicKey = window.Laravel.vapidPublicKey

        if (vapidPublicKey) {
          options.applicationServerKey = this.urlBase64ToUint8Array(vapidPublicKey)
        }

        registration.pushManager.subscribe(options)
          .then(subscription => {
            this.isPushEnabled = true
            this.pushButtonDisabled = false

            this.updateSubscription(subscription)
          })
          .catch(e => {
            if (Notification.permission === 'denied') {
              console.log('Permission for Notifications was denied')
              this.pushButtonDisabled = true
            } else {
              console.log('Unable to subscribe to push.', e)
              this.pushButtonDisabled = false
            }
          })
      })
    },

    /**
     * Unsubscribe from push notifications.
     */
    unsubscribe () {
      navigator.serviceWorker.ready.then(registration => {
        registration.pushManager.getSubscription().then(subscription => {
          if (!subscription) {
            this.isPushEnabled = false
            this.pushButtonDisabled = false
            return
          }

          subscription.unsubscribe().then(() => {
            this.deleteSubscription(subscription)

            this.isPushEnabled = false
            this.pushButtonDisabled = false
          }).catch(e => {
            console.log('Unsubscription error: ', e)
            this.pushButtonDisabled = false
          })
        }).catch(e => {
          console.log('Error thrown while unsubscribing.', e)
        })
      })
    },

    /**
     * Toggle push notifications subscription.
     */
    togglePush () {
      if (this.isPushEnabled) {
        this.unsubscribe()
      } else {
        this.subscribe()
      }
    },

    /**
     * Send a request to the server to update user's subscription.
     *
     * @param {PushSubscription} subscription
     */
    updateSubscription (subscription) {
      const key = subscription.getKey('p256dh')
      const token = subscription.getKey('auth')

      const data = {
        endpoint: subscription.endpoint,
        key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
        token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null
      }

      this.loading = true

      axios.post(`${this.asidePath}/en/notifications/subscriptions`, data)
        .then(() => { this.loading = false })
    },

    /**
     * Send a requst to the server to delete user's subscription.
     *
     * @param {PushSubscription} subscription
     */
    deleteSubscription (subscription) {
      this.loading = true

      axios.post(`${this.asidePath}/en/notifications/subscriptions/delete`, { endpoint: subscription.endpoint })
        .then(() => { this.loading = false })
    },

    /**
     * https://github.com/Minishlink/physbook/blob/02a0d5d7ca0d5d2cc6d308a3a9b81244c63b3f14/app/Resources/public/js/app.js#L177
     *
     * @param  {String} base64String
     * @return {Uint8Array}
     */
    urlBase64ToUint8Array (base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
          .replace(/\-/g, '+')
          .replace(/_/g, '/')

        const rawData = window.atob(base64)
        const outputArray = new Uint8Array(rawData.length)

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i)
        }

        return outputArray
    },

    /**
     * Fetch notifications.
     *
     * @param {Number} limit
     */
    fetch (limit = 5) {
      axios.get(`${this.asidePath}/notifications/notifications`, { params: { limit }})
        .then(({ data: { total, notifications }}) => {
          this.total = total
          this.notifications = notifications.map(({ id, data, created }) => {
            return {
              id: id,
              title: data.title,
              body: data.body,
              created: data.created,
              action_url: data.action_url,
              type: data.type,
              icon: data.icon
            }
          })
        })
    },

    /**
     * Fetch all notifications.
     *
     * @param {Number} limit
     */
    fetchAll (limit = null) {
      axios.get(`${this.asidePath}/notifications/notifications`, { params: { limit }})
        .then(({ data: { total, notifications }}) => {
          this.total = total
          this.notifications = notifications.map(({ id, data, created }) => {
            return {
              id: id,
              title: data.title,
              body: data.body,
              created: data.created,
              action_url: data.action_url,
              type: data.type,
              icon: data.icon
            }
          })
        })
    },

    /**
     * Mark the given notification as read.
     *
     * @param {Object} notification
     */
    markAsRead ({ id }) {
      const index = this.notifications.findIndex(n => n.id === id)

      if (index > -1) {
        this.total--
        this.notifications.splice(index, 1)
        axios.patch(`${this.asidePath}/notifications/notifications/${id}/read`)
      }
    },

    /**
     * Mark all notifications as read.
     */
    markAllRead () {
      this.total = 0
      this.notifications = []

      axios.post(`${this.asidePath}/notifications/notifications/mark-all-read`)
    },

    /**
     * Listen for Echo push notifications.
     */
    listen () {
      window.Echo.private(`App.User.${window.Laravel.user.id}`)
        .notification(notification => {
          this.total++
          this.notifications.unshift(notification)
        })
        .listen('NotificationRead', ({ notificationId }) => {
          this.total--

          const index = this.notifications.findIndex(n => n.id === notificationId)
          if (index > -1) {
            this.notifications.splice(index, 1)
          }
        })
        .listen('NotificationReadAll', () => {
          this.total = 0
          this.notifications = []
        })
    },
  }
}
</script>
