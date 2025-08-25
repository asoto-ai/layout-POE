// Ejemplo de uso de fetch para cargar páginas HTML

class PortalAPI {
    constructor(baseUrl = '') {
        this.baseUrl = baseUrl;
    }

    // Cargar contenido de una página específica
    async loadPageContent(pageName) {
        try {
            const response = await fetch(`${this.baseUrl}${pageName}.html`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const html = await response.text();
            return this.extractContent(html);
            
        } catch (error) {
            console.error('Error loading page:', error);
            throw error;
        }
    }

    // Extraer solo el contenido principal de una página
    extractContent(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Extraer diferentes secciones
        const mainContent = doc.querySelector('.main-content');
        const title = doc.querySelector('title')?.textContent;
        const header = doc.querySelector('.content-header');
        const body = doc.querySelector('.content-body');
        
        return {
            fullContent: mainContent?.innerHTML,
            title: title,
            header: header?.innerHTML,
            body: body?.innerHTML
        };
    }

    // Cargar múltiples páginas en paralelo
    async loadMultiplePages(pageNames) {
        try {
            const promises = pageNames.map(name => this.loadPageContent(name));
            const results = await Promise.all(promises);
            
            return pageNames.reduce((acc, name, index) => {
                acc[name] = results[index];
                return acc;
            }, {});
            
        } catch (error) {
            console.error('Error loading multiple pages:', error);
            throw error;
        }
    }

    // Buscar contenido específico en una página
    async searchInPage(pageName, selector) {
        try {
            const response = await fetch(`${this.baseUrl}${pageName}.html`);
            const html = await response.text();
            
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const elements = doc.querySelectorAll(selector);
            
            return Array.from(elements).map(el => ({
                text: el.textContent.trim(),
                html: el.innerHTML,
                tag: el.tagName.toLowerCase()
            }));
            
        } catch (error) {
            console.error('Error searching in page:', error);
            throw error;
        }
    }

    // Precargar páginas para navegación rápida
    async preloadPages(pageNames) {
        const cache = new Map();
        
        for (const pageName of pageNames) {
            try {
                const content = await this.loadPageContent(pageName);
                cache.set(pageName, content);
                console.log(`Página ${pageName} precargada`);
            } catch (error) {
                console.warn(`Error precargando ${pageName}:`, error);
            }
        }
        
        return cache;
    }
}

// Ejemplo de uso
async function ejemploUso() {
    const api = new PortalAPI();
    
    // 1. Cargar una página específica
    try {
        const informacion = await api.loadPageContent('informacion');
        console.log('Página información cargada:', informacion.title);
        
        // Insertar en el DOM
        document.getElementById('content').innerHTML = informacion.fullContent;
        
    } catch (error) {
        console.error('Error:', error);
    }
    
    // 2. Cargar múltiples páginas
    try {
        const pages = await api.loadMultiplePages(['talleres', 'eventos', 'capacitaciones']);
        console.log('Páginas cargadas:', Object.keys(pages));
        
    } catch (error) {
        console.error('Error:', error);
    }
    
    // 3. Buscar contenido específico
    try {
        const titles = await api.searchInPage('eventos', 'h6');
        console.log('Títulos encontrados en eventos:', titles);
        
    } catch (error) {
        console.error('Error:', error);
    }
    
    // 4. Precargar páginas
    try {
        const cache = await api.preloadPages(['informacion', 'talleres', 'eventos']);
        console.log('Páginas en cache:', cache.size);
        
    } catch (error) {
        console.error('Error:', error);
    }
}

// Exportar para uso en otros archivos
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PortalAPI;
}

// Ejemplo de navegación SPA simple
function setupSPANavigation() {
    const api = new PortalAPI();
    const contentDiv = document.getElementById('content');
    
    // Agregar listeners a enlaces del menú
    document.querySelectorAll('[data-page]').forEach(link => {
        link.addEventListener('click', async (e) => {
            e.preventDefault();
            
            const pageName = link.getAttribute('data-page');
            
            try {
                // Mostrar loading
                contentDiv.innerHTML = '<div class="text-center"><div class="spinner-border"></div></div>';
                
                // Cargar página
                const content = await api.loadPageContent(pageName);
                contentDiv.innerHTML = content.fullContent;
                
                // Actualizar título
                if (content.title) {
                    document.title = content.title;
                }
                
                // Marcar enlace como activo
                document.querySelectorAll('[data-page]').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                
            } catch (error) {
                contentDiv.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
            }
        });
    });
}

// Inicializar cuando el DOM esté listo
if (typeof document !== 'undefined') {
    document.addEventListener('DOMContentLoaded', setupSPANavigation);
}