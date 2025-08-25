// Main JavaScript for Intranet Application
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the application
    initSidebar();
    initNavigation();
    initMobileMenu();
    initSearchBox();
    initAnimations();
});

// Sidebar functionality
function initSidebar() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mobileToggle = document.getElementById('mobileToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    // Toggle sidebar on mobile
    if (mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            toggleSidebar();
        });
    }
    
    // Close sidebar button
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            closeSidebar();
        });
    }
    
    // Close sidebar when clicking overlay
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            closeSidebar();
        });
    }
    
    // Close sidebar on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });
}

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        
        // Prevent body scroll when sidebar is open
        if (sidebar.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }
}

// Navigation functionality
function initNavigation() {
    const navLinks = document.querySelectorAll('.nav-link[data-section]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const sectionName = this.getAttribute('data-section');
            showSection(sectionName);
            setActiveNavLink(this);
            
            // Close mobile sidebar after navigation
            if (window.innerWidth < 992) {
                closeSidebar();
            }
        });
    });
}

function showSection(sectionName) {
    // Hide all sections
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.remove('active');
    });
    
    // Show target section
    const targetSection = document.getElementById(sectionName);
    if (targetSection) {
        targetSection.classList.add('active');
        
        // Scroll to top of content area
        const contentArea = document.querySelector('.content-area');
        if (contentArea) {
            contentArea.scrollTop = 0;
        }
        
        // Update page title if needed
        updatePageTitle(sectionName);
    }
}

function setActiveNavLink(activeLink) {
    // Remove active class from all nav links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.classList.remove('active');
    });
    
    // Add active class to current link
    activeLink.classList.add('active');
}

function updatePageTitle(sectionName) {
    const titles = {
        dashboard: 'Dashboard - Intranet Corporativa',
        projects: 'Proyectos - Intranet Corporativa',
        team: 'Equipo - Intranet Corporativa',
        reports: 'Reportes - Intranet Corporativa',
        documents: 'Documentos - Intranet Corporativa',
        calendar: 'Calendario - Intranet Corporativa',
        settings: 'Configuración - Intranet Corporativa'
    };
    
    if (titles[sectionName]) {
        document.title = titles[sectionName];
    }
}

// Mobile menu functionality
function initMobileMenu() {
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            closeSidebar();
        }
    });
    
    // Handle orientation change on mobile
    window.addEventListener('orientationchange', function() {
        setTimeout(() => {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        }, 100);
    });
}

// Search box functionality
function initSearchBox() {
    const searchInput = document.querySelector('.search-box input');
    
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch(this.value);
            }
        });
        
        // Add search icon click functionality
        const searchIcon = document.querySelector('.search-box i');
        if (searchIcon) {
            searchIcon.addEventListener('click', function() {
                performSearch(searchInput.value);
            });
        }
    }
}

function performSearch(query) {
    if (query.trim() === '') {
        showNotification('Por favor, ingrese un término de búsqueda', 'warning');
        return;
    }
    
    // Simulate search functionality
    showNotification(`Buscando: "${query}"...`, 'info');
    
    // Here you would implement actual search logic
    // For now, we'll just show a notification
    setTimeout(() => {
        showNotification(`Búsqueda completada para: "${query}"`, 'success');
    }, 1500);
}

// Animation and interaction functions
function initAnimations() {
    // Add hover effects to cards
    const cards = document.querySelectorAll('.stat-card, .project-card, .team-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Initialize progress bar animations
    animateProgressBars();
    
    // Initialize counter animations for stat cards
    animateCounters();
}

function animateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar');
    
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        
        setTimeout(() => {
            bar.style.transition = 'width 1s ease-in-out';
            bar.style.width = width;
        }, 500);
    });
}

function animateCounters() {
    const counters = document.querySelectorAll('.stat-content h3');
    
    counters.forEach(counter => {
        const target = parseInt(counter.textContent);
        if (isNaN(target)) return;
        
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target;
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current);
            }
        }, 30);
    });
}

// Notification system
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show notification-toast`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        max-width: 400px;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease-in-out;
    `;
    
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        removeNotification(notification);
    }, 5000);
    
    // Handle close button
    const closeBtn = notification.querySelector('.btn-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            removeNotification(notification);
        });
    }
}

function removeNotification(notification) {
    notification.style.opacity = '0';
    notification.style.transform = 'translateX(100%)';
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 300);
}

// Utility functions
function formatDate(date) {
    return new Intl.DateTimeFormat('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }).format(date);
}

function formatTime(date) {
    return new Intl.DateTimeFormat('es-ES', {
        hour: '2-digit',
        minute: '2-digit'
    }).format(date);
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Form handling
function handleFormSubmit(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        
        // Simulate form submission
        showNotification('Guardando cambios...', 'info');
        
        setTimeout(() => {
            showNotification('Cambios guardados exitosamente', 'success');
        }, 1500);
    });
}

// Initialize form handlers
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        handleFormSubmit(form);
    });
});

// Theme switching functionality
function initThemeSwitch() {
    const darkModeToggle = document.getElementById('darkMode');
    
    if (darkModeToggle) {
        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-theme');
            darkModeToggle.checked = true;
        }
        
        darkModeToggle.addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark-theme');
                localStorage.setItem('theme', 'dark');
                showNotification('Modo oscuro activado', 'info');
            } else {
                document.body.classList.remove('dark-theme');
                localStorage.setItem('theme', 'light');
                showNotification('Modo claro activado', 'info');
            }
        });
    }
}

// Initialize theme switching
document.addEventListener('DOMContentLoaded', function() {
    initThemeSwitch();
});

// Handle clicks on action buttons
document.addEventListener('click', function(e) {
    // Handle download buttons
    if (e.target.closest('.btn') && e.target.closest('.btn').innerHTML.includes('fa-download')) {
        e.preventDefault();
        showNotification('Descarga iniciada', 'success');
    }
    
    // Handle share buttons
    if (e.target.closest('.btn') && e.target.closest('.btn').innerHTML.includes('fa-share')) {
        e.preventDefault();
        showNotification('Enlace copiado al portapapeles', 'info');
    }
    
    // Handle email buttons
    if (e.target.closest('.btn') && e.target.closest('.btn').innerHTML.includes('fa-envelope')) {
        e.preventDefault();
        showNotification('Abriendo cliente de correo...', 'info');
    }
    
    // Handle phone buttons
    if (e.target.closest('.btn') && e.target.closest('.btn').innerHTML.includes('fa-phone')) {
        e.preventDefault();
        showNotification('Iniciando llamada...', 'info');
    }
});

// Add loading states to buttons
function addLoadingState(button) {
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cargando...';
    button.disabled = true;
    
    return function removeLoadingState() {
        button.innerHTML = originalText;
        button.disabled = false;
    };
}

// Export functions for potential use in other scripts
window.IntranetApp = {
    showSection,
    showNotification,
    toggleSidebar,
    closeSidebar,
    addLoadingState
};
