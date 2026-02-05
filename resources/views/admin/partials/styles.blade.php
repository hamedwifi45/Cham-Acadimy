<style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8fafc;
        }
        
        .sidebar {
            transition: all 0.3s ease;

        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .activity-item {
            transition: all 0.2s ease;
        }
        
        .activity-item:hover {
            background-color: #f1f5f9;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .status-active {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .status-inactive {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .quick-action-btn {
            transition: all 0.2s ease;
        }
        
        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }
        
        .notification-item {
            border-left: 4px solid #3b82f6;
        }
    
</style>