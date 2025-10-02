<template>
  <div class="notifications-container">
    <!-- Notification Bell -->
    <div class="notification-bell" @click="toggleDropdown">
      <div class="bell-icon">
        <i class="fas fa-bell"></i>
        <span v-if="unreadCount > 0" class="badge">{{ unreadCount }}</span>
      </div>
      
      <!-- Dropdown -->
      <div v-if="showDropdown" class="notification-dropdown">
        <div class="notification-header">
          <h3>Notifications</h3>
          <div class="header-actions">
            <button 
              v-if="unreadCount > 0" 
              @click="markAllAsRead" 
              class="btn-mark-all"
            >
              Mark all as read
            </button>
            <button @click="clearAll" class="btn-clear-all">
              Clear all
            </button>
          </div>
        </div>
        
        <div class="notification-list">
          <div 
            v-for="notification in notifications" 
            :key="notification.id"
            :class="['notification-item', { unread: !notification.read_at }]"
            @click="markAsRead(notification.id)"
          >
            <div class="notification-icon" :class="notification.data.type">
              <i :class="getIcon(notification.data.type)"></i>
            </div>
            <div class="notification-content">
              <h4>{{ notification.data.title }}</h4>
              <p>{{ notification.data.message }}</p>
              <small>{{ formatDate(notification.created_at) }}</small>
              <a 
                v-if="notification.data.action_url" 
                :href="notification.data.action_url"
                class="action-link"
              >
                {{ notification.data.action_text || 'View' }}
              </a>
            </div>
            <button 
              @click.stop="deleteNotification(notification.id)" 
              class="btn-delete"
            >
              ×
            </button>
          </div>
          
          <div v-if="notifications.length === 0" class="empty-state">
            No notifications
          </div>
        </div>
        
        <div class="notification-footer">
          <router-link to="/notifications">View all notifications</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotificationBell',
  data() {
    return {
      showDropdown: false,
      notifications: [],
      unreadCount: 0,
      polling: null
    }
  },
  
  mounted() {
    this.fetchNotifications();
    this.startPolling();
    this.setupEcho();
    
    // Close dropdown when clicking outside
    document.addEventListener('click', this.handleClickOutside);
  },
  
  beforeUnmount() {
    if (this.polling) {
      clearInterval(this.polling);
    }
    document.removeEventListener('click', this.handleClickOutside);
  },
  
  methods: {
    async fetchNotifications() {
      try {
        const response = await this.$http.get('/api/notifications');
        this.notifications = response.data.notifications.data;
        this.unreadCount = response.data.unread_count;
      } catch (error) {
        console.error('Error fetching notifications:', error);
      }
    },
    
    async markAsRead(notificationId) {
      try {
        await this.$http.post(`/api/notifications/${notificationId}/read`);
        await this.fetchNotifications();
      } catch (error) {
        console.error('Error marking notification as read:', error);
      }
    },
    
    async markAllAsRead() {
      try {
        await this.$http.post('/api/notifications/read-all');
        await this.fetchNotifications();
      } catch (error) {
        console.error('Error marking all as read:', error);
      }
    },
    
    async deleteNotification(notificationId) {
      try {
        await this.$http.delete(`/api/notifications/${notificationId}`);
        await this.fetchNotifications();
      } catch (error) {
        console.error('Error deleting notification:', error);
      }
    },
    
    async clearAll() {
      try {
        await this.$http.delete('/api/notifications');
        await this.fetchNotifications();
      } catch (error) {
        console.error('Error clearing notifications:', error);
      }
    },
    
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    
    handleClickOutside(event) {
      if (!this.$el.contains(event.target)) {
        this.showDropdown = false;
      }
    },
    
    getIcon(type) {
      const icons = {
        info: 'fas fa-info-circle',
        success: 'fas fa-check-circle',
        warning: 'fas fa-exclamation-triangle',
        error: 'fas fa-times-circle'
      };
      return icons[type] || icons.info;
    },
    
    formatDate(date) {
      return new Date(date).toLocaleDateString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
      });
    },
    
    startPolling() {
      this.polling = setInterval(() => {
        this.fetchNotifications();
      }, 30000); // Poll every 30 seconds
    },
    
    setupEcho() {
      // Laravel Echo setup for real-time notifications
      if (window.Echo) {
        window.Echo.private(`App.Models.User.${this.$user.id}`)
          .notification((notification) => {
            this.fetchNotifications(); // Refresh when new notification arrives
          });
      }
    }
  }
}
</script>

<style scoped>
.notifications-container {
  position: relative;
}

.notification-bell {
  cursor: pointer;
  position: relative;
}

.bell-icon {
  position: relative;
  font-size: 1.5rem;
  color: #6c757d;
}

.badge {
  position: absolute;
  top: -8px;
  right: -8px;
  background: #dc3545;
  color: white;
  border-radius: 50%;
  width: 18px;
  height: 18px;
  font-size: 0.7rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.notification-dropdown {
  position: absolute;
  top: 100%;
  right: 0;
  width: 400px;
  background: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  z-index: 1000;
}

.notification-header {
  padding: 1rem;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.notification-header h3 {
  margin: 0;
  font-size: 1.1rem;
}

.header-actions {
  display: flex;
  gap: 0.5rem;
}

.btn-mark-all, .btn-clear-all {
  background: none;
  border: none;
  color: #007bff;
  cursor: pointer;
  font-size: 0.8rem;
}

.btn-mark-all:hover, .btn-clear-all:hover {
  text-decoration: underline;
}

.notification-list {
  max-height: 400px;
  overflow-y: auto;
}

.notification-item {
  display: flex;
  padding: 1rem;
  border-bottom: 1px solid #f0f0f0;
  cursor: pointer;
  transition: background-color 0.2s;
}

.notification-item:hover {
  background-color: #f8f9fa;
}

.notification-item.unread {
  background-color: #f0f7ff;
}

.notification-icon {
  margin-right: 1rem;
  font-size: 1.2rem;
}

.notification-icon.info { color: #17a2b8; }
.notification-icon.success { color: #28a745; }
.notification-icon.warning { color: #ffc107; }
.notification-icon.error { color: #dc3545; }

.notification-content {
  flex: 1;
}

.notification-content h4 {
  margin: 0 0 0.5rem 0;
  font-size: 0.9rem;
}

.notification-content p {
  margin: 0 0 0.5rem 0;
  font-size: 0.8rem;
  color: #666;
}

.notification-content small {
  color: #999;
  font-size: 0.7rem;
}

.action-link {
  display: inline-block;
  margin-top: 0.5rem;
  color: #007bff;
  text-decoration: none;
  font-size: 0.8rem;
}

.action-link:hover {
  text-decoration: underline;
}

.btn-delete {
  background: none;
  border: none;
  color: #999;
  cursor: pointer;
  font-size: 1.2rem;
  padding: 0;
  width: 20px;
  height: 20px;
}

.btn-delete:hover {
  color: #dc3545;
}

.empty-state {
  padding: 2rem;
  text-align: center;
  color: #999;
}

.notification-footer {
  padding: 1rem;
  border-top: 1px solid #eee;
  text-align: center;
}

.notification-footer a {
  color: #007bff;
  text-decoration: none;
}

.notification-footer a:hover {
  text-decoration: underline;
}
</style>