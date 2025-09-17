<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talleres Deportivos OE Chile</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" sizes="192x192" href="https://static.wixstatic.com/media/10aafd_df6a30cf16d941aaa72c5e91af502b95%7Emv2.png/v1/fill/w_192%2Ch_192%2Clg_1%2Cusm_0.66_1.00_0.01/10aafd_df6a30cf16d941aaa72c5e91af502b95%7Emv2.png" type="image/png">
    
    <style>
        /* ==========================================================================
           Professional Talleres Deportivos OE Chile Styles
           ========================================================================== */

        :root {
            --primary-color: #007BFF;
            --primary-light: #3399FF;
            --primary-dark: #0056CC;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b35;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --border-color: #e9ecef;
            --shadow-light: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-medium: 0 4px 8px rgba(0,0,0,0.15);
            --shadow-heavy: 0 8px 24px rgba(0,0,0,0.2);
            --border-radius: 8px;
            --border-radius-lg: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Theme variables */
            --bg-color: #ffffff;
            --text-color: #2c3e50;
            --sidebar-bg: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            --resumen-bg: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            --card-bg: #ffffff;
            --popup-bg: #ffffff;
        }

        [data-theme="dark"] {
            --primary-color: #4A90E2;
            --primary-light: #6BA3F0;
            --primary-dark: #357ABD;
            --secondary-color: #2d3748;
            --accent-color: #ff6b35;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --danger-color: #f56565;
            --dark-color: #e2e8f0;
            --light-color: #2d3748;
            --border-color: #4a5568;
            --shadow-light: 0 2px 4px rgba(0,0,0,0.3);
            --shadow-medium: 0 4px 8px rgba(0,0,0,0.4);
            --shadow-heavy: 0 8px 24px rgba(0,0,0,0.5);
            
            /* Dark theme variables */
            --bg-color: #1a202c;
            --text-color: #e2e8f0;
            --sidebar-bg: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            --resumen-bg: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            --card-bg: #2d3748;
            --popup-bg: #2d3748;
        }

        /* Dark theme specific adjustments */
        [data-theme="dark"] .geo-list li a {
            color: #cbd5e0;
        }

        [data-theme="dark"] .geo-list li a:hover {
            color: #4A90E2;
        }

        /* ==========================================================================
           Base Styles
           ========================================================================== */

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            height: 100dvh; /* Para navegadores que soportan viewport dinámico */
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            transition: var(--transition);
            overflow: hidden; /* Prevenir scroll en el body */
        }

        /* ==========================================================================
           Layout
           ========================================================================== */

        .main-container {
            display: flex;
            flex-direction: row;
            height: 100vh;
            position: relative;
        }

        /* Mobile hamburger menu */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 80px;
            z-index: 1001;
            background: white;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            box-shadow: var(--shadow-medium);
            color: var(--dark-color);
            cursor: pointer;
            transition: var(--transition);
        }

        .mobile-menu-toggle:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-heavy);
        }

        .mobile-menu-toggle i {
            font-size: 16px;
        }

        /* Botón cerrar móvil */
        .mobile-close-btn {
            display: none;
            position: absolute;
            top: 16px;
            right: 16px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            cursor: pointer;
            z-index: 1001;
            box-shadow: var(--shadow-medium);
            transition: var(--transition);
        }

        .mobile-close-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.1);
        }

        .mobile-close-btn i {
            font-size: 14px;
        }

        .sidebar {
            width: 340px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding: 24px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) var(--secondary-color);
        }

        /* Estilos base para desktop */
        @media (min-width: 769px) {
            .sidebar {
                position: relative;
            }
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--secondary-color);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        .sidebar h3 {
            margin-top: 0;
            color: var(--dark-color);
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .sidebar h3 i {
            margin-right: 12px;
            color: var(--primary-color);
        }

        .subtitle {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .map-area {
            flex-grow: 1;
            position: relative;
        }

        /* ==========================================================================
           Map Styles
           ========================================================================== */

        #map {
            width: 100%;
            height: 100%;
        }

        .leaflet-control-attribution {
            display: none !important;
        }

        .map-controls {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 1000;
            display: flex;
            gap: 8px;
        }

        .map-control-btn {
            background: white;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-medium);
            color: var(--dark-color);
            cursor: pointer;
            transition: var(--transition);
        }

        .map-control-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-heavy);
        }

        /* ==========================================================================
           Loading Styles
           ========================================================================== */

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(2px);
        }

        .loading-content {
            background: white;
            padding: 30px 40px;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-heavy);
            text-align: center;
            display: flex;
            align-items: center;
            gap: 16px;
            color: var(--text-color);
        }

        .loading-spinner {
            width: 24px;
            height: 24px;
            border: 3px solid var(--border-color);
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Error message */
        .error-message {
            color: var(--danger-color);
            text-align: center;
            padding: 20px;
            background: #ffe6e6;
            border-radius: var(--border-radius);
            margin: 20px 0;
        }

        /* ==========================================================================
           Statistics Cards
           ========================================================================== */

        .stats-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            padding: 16px;
            border-radius: var(--border-radius);
            text-align: center;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
        }

        .stat-label {
            font-size: 12px;
            opacity: 0.9;
            margin-top: 4px;
        }

        /* ==========================================================================
           Navigation Styles
           ========================================================================== */

        .home-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 24px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .home-btn i {
            margin-right: 8px;
        }

        .home-btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-medium);
        }

        .region-header {
            margin: 12px 0;
            cursor: pointer;
            color: var(--text-color);
            font-size: 16px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            padding: 12px 16px;
            border-radius: var(--border-radius);
            background: var(--card-bg);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }

        .region-header:hover {
            box-shadow: var(--shadow-medium);
            border-color: var(--primary-light);
        }

        .region-header .arrow {
            font-size: 14px;
            color: var(--primary-color);
            transition: var(--transition);
        }

        .region-header.collapsed .arrow {
            transform: rotate(-90deg);
        }

        .region-header.seleccionado {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            border-color: var(--primary-color);
        }

        .region-header.seleccionado .arrow {
            color: white;
        }

        .geo-list {
            display: none;
            margin: 8px 0 16px 0;
            padding: 16px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            font-size: 14px;
            color: var(--text-color);
        }

        .geo-list li {
            margin-bottom: 8px;
            position: relative;
            padding-left: 48px;
            line-height: 1.4;
        }

        .geo-list li::before {
            content: '•';
            position: absolute;
            left: 20px;
            color: var(--primary-color);
            font-size: 16px;
            font-weight: bold;
        }

        .geo-list li a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: var(--transition);
        }

        .geo-list li a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .geo-list li a.seleccionado {
            font-weight: 700;
            color: var(--primary-color);
        }

        .geo-list li a.seleccionado::before {
            content: '📍 ';
            position: absolute;
            left: -32px;
            font-size: 14px;
        }

        /* ==========================================================================
           Institution Styles
           ========================================================================== */

        .region-container {
            margin: 8px 0 16px 0;
            padding: 12px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
        }

        .institucion-header {
            margin: 8px 0;
            cursor: pointer;
            color: var(--text-color);
            font-size: 14px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            border-radius: var(--border-radius);
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .institucion-header:hover {
            box-shadow: var(--shadow-light);
            border-color: var(--accent-color);
            background: linear-gradient(135deg, #fff8f6 0%, #f8f9fa 100%);
        }

        .institucion-header.expanded {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ff8c5a 100%);
            color: white;
            border-color: var(--accent-color);
        }

        .institucion-header .arrow-small {
            font-size: 12px;
            color: var(--accent-color);
            transition: var(--transition);
        }

        .institucion-header.expanded .arrow-small {
            color: white;
            transform: rotate(180deg);
        }

        .talleres-list {
            margin: 8px 0 0 0;
            padding: 12px;
            background: #f8f9fa;
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            display: none;
        }

        /* ==========================================================================
           Popup Styles
           ========================================================================== */

        .leaflet-popup-content-wrapper {
            background: var(--popup-bg);
            color: var(--text-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-heavy);
            border: 1px solid var(--border-color);
        }

        .leaflet-popup-tip {
            background: var(--popup-bg);
            border: 1px solid var(--border-color);
        }

        .popup-header {
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .popup-header strong {
            font-size: 16px;
            color: var(--primary-color);
            display: block;
            margin-bottom: 4px;
        }

        .popup-header span {
            font-size: 14px;
            color: #6c757d;
        }

        .popup-content {
            font-size: 13px;
            line-height: 1.6;
        }

        .popup-content strong {
            color: var(--dark-color);
            font-weight: 600;
        }

        .popup-content a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .popup-content a:hover {
            text-decoration: underline;
        }

        .copy-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: var(--border-radius);
            font-size: 12px;
            cursor: pointer;
            margin-top: 8px;
            transition: var(--transition);
        }

        .copy-button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .copy-button i {
            margin-right: 4px;
        }

        /* ==========================================================================
           Marker Cluster Styles
           ========================================================================== */

        .marker-cluster-small {
            background-color: rgba(181, 226, 140, 0.8);
            border: 2px solid rgba(181, 226, 140, 1);
        }

        .marker-cluster-small div {
            background-color: rgba(110, 204, 57, 0.8);
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            line-height: 32px;
        }

        .marker-cluster-medium {
            background-color: rgba(241, 211, 87, 0.8);
            border: 2px solid rgba(241, 211, 87, 1);
        }

        .marker-cluster-medium div {
            background-color: rgba(240, 194, 12, 0.8);
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            line-height: 32px;
        }

        .marker-cluster-large {
            background-color: rgba(253, 156, 115, 0.8);
            border: 2px solid rgba(253, 156, 115, 1);
        }

        .marker-cluster-large div {
            background-color: rgba(241, 128, 23, 0.8);
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            line-height: 32px;
        }

        /* ==========================================================================
           Custom Marker Styles
           ========================================================================== */

        .custom-marker-favicon {
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            border: 2px solid var(--primary-color);
        }

        .custom-marker-favicon img {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        /* Mejorar popups en dispositivos móviles */
        .leaflet-popup-content-wrapper {
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-heavy);
        }

        .leaflet-popup-content {
            margin: 16px !important;
            line-height: 1.4;
        }

        .popup-header {
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary-color);
        }

        .popup-header strong {
            display: block;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 4px;
        }

        .popup-header span {
            font-size: 14px;
            color: var(--text-color);
            font-weight: 600;
        }

        .popup-content {
            font-size: 13px;
            color: var(--text-color);
        }

        .copy-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            font-size: 12px;
            cursor: pointer;
            margin-top: 8px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .copy-button:hover {
            background: #0056b3;
        }

        .copy-button:active {
            background: #004085;
        }

        /* Mejorar popups en dispositivos táctiles */
        @media (max-width: 768px) {
            .leaflet-popup-content-wrapper {
                max-width: 280px !important;
                min-width: 250px !important;
            }

            .leaflet-popup-content {
                margin: 12px !important;
                max-height: 300px;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            .popup-header strong {
                font-size: 15px;
            }

            .popup-content {
                font-size: 12px;
            }

            .copy-button {
                padding: 10px 12px;
                font-size: 13px;
                -webkit-tap-highlight-color: transparent;
            }

            /* Asegurar que los popups sean táctiles */
            .leaflet-popup {
                pointer-events: auto !important;
            }

            .leaflet-popup-tip-container {
                pointer-events: none !important;
            }
        }



        /* ==========================================================================
           Responsive Design - Mobile
           ========================================================================== */

        @media (max-width: 768px) {
            /* Asegurar altura completa en móviles */
            html, body {
                overflow-x: hidden;
                position: relative;
            }

            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar {
                position: fixed;
                left: -340px;
                top: 0;
                bottom: 0;
                height: 100vh;
                height: 100dvh; /* Para navegadores que soportan viewport dinámico */
                min-height: 100vh;
                width: 340px;
                z-index: 1000;
                transition: left 0.3s ease;
                background: var(--sidebar-bg);
                border-right: 1px solid var(--border-color);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                padding: 16px;
                box-shadow: 2px 0 20px rgba(0,0,0,0.15);
                display: flex;
                flex-direction: column;
            }

            .mobile-close-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar.open {
                left: 0;
            }

            .main-container {
                height: 100vh;
                overflow: hidden;
            }

            .map-area {
                width: 100%;
                height: 100vh;
                flex: none;
            }

            .map-controls {
                top: 16px;
                right: 16px;
            }

            /* Overlay para cerrar el menú */
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                height: 100dvh; /* Para navegadores que soportan viewport dinámico */
                min-height: 100vh;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .sidebar-overlay.active {
                display: block;
                opacity: 1;
            }

            /* Ajustes para el sidebar en móvil */
            .sidebar h3 {
                margin-bottom: 16px;
                text-align: center;
                flex-shrink: 0;
            }

            .sidebar h3 img {
                height: 80px;
                display: block;
                margin: 0 auto 8px auto;
            }

            .stats-container {
                grid-template-columns: 1fr;
                gap: 8px;
                margin-bottom: 16px;
                flex-shrink: 0;
            }

            .stat-card {
                padding: 12px;
            }

            .stat-number {
                font-size: 18px;
            }

            .stat-label {
                font-size: 11px;
            }

            .home-btn {
                padding: 10px 16px;
                font-size: 14px;
                margin-bottom: 16px;
                flex-shrink: 0;
            }

            #asociacionesList {
                flex: 1;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                padding-right: 4px;
            }

            .region-header {
                font-size: 14px;
                padding: 10px 12px;
            }

            .geo-list {
                padding: 12px;
                font-size: 13px;
            }

            .institucion-header {
                font-size: 13px;
                padding: 8px 10px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
                left: -100%;
                height: 100vh;
                height: 100dvh; /* Para navegadores que soportan viewport dinámico */
                min-height: 100vh;
                bottom: 0;
                box-shadow: 0 0 30px rgba(0,0,0,0.3);
                display: flex;
                flex-direction: column;
            }

            .sidebar.open {
                left: 0;
                transform: translateZ(0); /* Activar aceleración por hardware */
            }

            .mobile-menu-toggle {
                width: 40px;
                height: 40px;
            }

            .map-control-btn {
                width: 40px;
                height: 40px;
            }

            .sidebar h3 img {
                height: 60px;
            }

            .sidebar h3 {
                font-size: 18px;
                margin-bottom: 12px;
                flex-shrink: 0;
            }

            #asociacionesList {
                flex: 1;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                padding-right: 4px;
            }
        }

        /* ==========================================================================
           Responsive Design
           ========================================================================== */

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                max-height: 40vh;
                order: 1;
            }

            .map-area {
                height: 60vh;
                order: 2;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .theme-controls {
                position: fixed;
                top: auto;
                bottom: 20px;
                right: 20px;
            }

            .region-header {
                font-size: 14px;
                padding: 8px 12px;
            }

            .geo-list {
                padding: 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                padding: 16px;
            }

            .sidebar h3 {
                font-size: 20px;
            }

            .stat-number {
                font-size: 20px;
            }

            .theme-btn {
                padding: 6px 10px;
                font-size: 12px;
            }
        }

        /* ==========================================================================
           Dark Theme Map Tiles Override
           ========================================================================== */

        [data-theme="dark"] .leaflet-tile {
            filter: brightness(0.6) invert(1) contrast(3) hue-rotate(200deg) saturate(0.3) brightness(0.7);
        }

        [data-theme="dark"] .leaflet-control-attribution {
            background: rgba(45, 55, 72, 0.8) !important;
            color: #cbd5e0 !important;
        }

        [data-theme="dark"] .leaflet-control-layers {
            background: var(--card-bg) !important;
            border: 1px solid var(--border-color) !important;
        }

        [data-theme="dark"] .leaflet-control-layers-title {
            color: var(--text-color) !important;
        }

        [data-theme="dark"] .leaflet-control-layers label {
            color: var(--text-color) !important;
        }
    </style>
</head>

<body>
    <!-- Loading Spinner -->
    <div id="loading-spinner" class="loading-overlay">
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <span>Cargando talleres deportivos...</span>
        </div>
    </div>

    <!-- Mobile menu toggle -->
    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar overlay for mobile -->
    <div class="sidebar-overlay" onclick="closeMobileMenu()"></div>

    <div class="main-container">
        <div class="sidebar" id="sidebar">
            <!-- Botón cerrar para móvil -->
            <button class="mobile-close-btn" onclick="closeMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
            
            <h5 style="display: flex; justify-content: space-between; align-items: center; flex-direction: row;">
                <span>Talleres Deportivos</span>
                <img src="https://poe.olimpiadasespecialeschile.net/static/img/logoPoe2.png" style="height: 80px;">
            </h5>

            <!-- Estadísticas -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number" id="total-talleres">0</div>
                    <div class="stat-label">Talleres</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="total-deportes">0</div>
                    <div class="stat-label">Deportes</div>
                </div>
            </div>

            <!-- Botón home -->
            <button class="home-btn" onclick="goHome()">
                <i class="fas fa-home"></i>
                Ver Todos los Talleres
            </button>

            <!-- Lista de regiones -->
            <ul id="asociacionesList">
                <!-- Se llena dinámicamente -->
            </ul>
        </div>

        <div class="map-area">
            <!-- Map Controls -->
            <div class="map-controls">
                <button class="map-control-btn" onclick="toggleTheme()" title="Cambiar tema" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </button>
                <button class="map-control-btn" onclick="centerOnChile()" title="Centrar en Chile">
                    <i class="fas fa-crosshairs"></i>
                </button>
                <button class="map-control-btn" onclick="toggleFullscreen()" title="Pantalla completa">
                    <i class="fas fa-expand"></i>
                </button>
            </div>



            <div id="map"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let map;
        let cluster;
        let todosLosMarkers = [];

        function getRegionCoordinates(region) {
            const coordenadas = {
                // CORRECCIÓN 3: Coordenadas precisas de Google Maps para regiones
                'Región de Arica y Parinacota': [-18.4783,-70.3126],
                'Región de Tarapacá': [-20.2141,-69.4415],
                'Región de Antofagasta': [-23.627,-70.569],
                'Región de Atacama': [-27.3668,-70.3323],
                'Región de Coquimbo': [-29.9533,-71.3372],
                'Región de Valparaíso': [-32.7436,-71.1138],
                'Región Metropolitana': [-33.4489,-70.6693],
                'Región de O\'Higgins': [-34.5755,-71.0022],
                'Región del Maule': [-35.4264,-71.6554],
                'Región de Ñuble': [-36.6083,-72.1036],
                'Región del Biobío': [-37.4689,-72.3527],
                'Región de la Araucanía': [-38.9489,-72.3311],
                'Región de Los Ríos': [-39.8142,-73.2459],
                'Región de Los Lagos': [-41.4693,-72.9424],
                'Región de Aysén': [-45.5752,-72.0662],
                'Región de Magallanes': [-53.1638,-70.9171],
                // Nombres sin "Región de..."
                'Arica y Parinacota': [-18.4783,-70.3126],
                'Tarapacá': [-20.2141,-69.4415],
                'Antofagasta': [-23.627,-70.569],
                'Atacama': [-27.3668,-70.3323],
                'Coquimbo': [-29.9533,-71.3372],
                'Valparaíso': [-32.7436,-71.1138],
                'Metropolitana de Santiago': [-33.4489,-70.6693],
                'Libertador General Bernardo O\'Higgins': [-34.5755,-71.0022],
                'Maule': [-35.4264,-71.6554],
                'Ñuble': [-36.6083,-72.1036],
                'Biobío': [-37.4689,-72.3527],
                'La Araucanía': [-38.9489,-72.3311],
                'Los Ríos': [-39.8142,-73.2459],
                'Los Lagos': [-41.4693,-72.9424],
                'Aysén del General Carlos Ibáñez del Campo': [-45.5752,-72.0662],
                'Magallanes y de la Antártica Chilena': [-53.1638,-70.9171]
            };
            return coordenadas[region] || [-33.45, -70.6667];
        }

        function showLoadingSpinner() {
            document.getElementById('loading-spinner').style.display = 'flex';
        }

        function hideLoadingSpinner() {
            document.getElementById('loading-spinner').style.display = 'none';
        }

        function goHome() {
            // Reset map view
            map.setView([-33.45, -70.6667], 4);
            
            // Clear and reload all markers
            cluster.clearLayers();
            todosLosMarkers.forEach(m => cluster.addLayer(m));
            map.addLayer(cluster);
            
            // Reset UI
            document.querySelectorAll('.region-header').forEach(el => el.classList.remove('seleccionado'));
            document.querySelectorAll('.region-container').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.talleres-list').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.deporte-header').forEach(el => el.classList.remove('expanded'));
            

            
            // Cerrar menú móvil si está abierto
            if (window.innerWidth <= 768) {
                closeMobileMenu();
            }
        }

        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            updateThemeButtons(theme);
            
            // Update map layers based on theme
            if (theme === 'dark' && window.sateliteLayer && !map.hasLayer(window.sateliteLayer)) {
                if (window.calleLayer) map.removeLayer(window.calleLayer);
                map.addLayer(window.sateliteLayer);
            } else if (theme === 'light' && window.calleLayer && !map.hasLayer(window.calleLayer)) {
                if (window.sateliteLayer) map.removeLayer(window.sateliteLayer);
                map.addLayer(window.calleLayer);
            }
        }

        function updateThemeButtons(theme) {
            document.getElementById('lightBtn').classList.toggle('active', theme === 'light');
            document.getElementById('darkBtn').classList.toggle('active', theme === 'dark');
        }

        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(() => {
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i> ¡Copiado!';
                setTimeout(() => {
                    button.innerHTML = originalText;
                }, 2000);
            });
        }

        async function initMap() {
            try {
                showLoadingSpinner();
                
                const response = await fetch('talleresDeportivos_datos2.php');
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                
                const geos = await response.json();

                map = L.map('map', {
                    tap: true,
                    tapTolerance: 15,
                    touchZoom: true,
                    doubleClickZoom: true,
                    scrollWheelZoom: true,
                    boxZoom: true,
                    keyboard: true,
                    zoomControl: true
                }).setView([-33.45, -70.6667], 4);

                // Configurar capas del mapa
                window.calleLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                    attribution: '&copy; Esri',
                    maxZoom: 19
                });

                window.sateliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: '&copy; Esri'
                });

                // Aplicar capa inicial según tema
                const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
                if (currentTheme === 'dark') {
                    window.sateliteLayer.addTo(map);
                } else {
                    window.calleLayer.addTo(map);
                }

                // Control de capas
                const baseMaps = {
                    "Calles": window.calleLayer,
                    "Satelital": window.sateliteLayer
                };
                L.control.layers(baseMaps, null, {
                    position: 'bottomleft'
                }).addTo(map);

                // CORRECCIÓN 2: Configuración mejorada para clusters numéricas
                cluster = L.markerClusterGroup({
                    maxClusterRadius: 25,
                    spiderfyOnMaxZoom: true,
                    showCoverageOnHover: false,
                    zoomToBoundsOnClick: true,
                    spiderfyDistanceMultiplier: 2,
                    disableClusteringAtZoom: 13,
                    iconCreateFunction: function(cluster) {
                        const count = cluster.getChildCount();
                        let size = 'small';
                        let className = 'marker-cluster-small';
                        
                        if (count >= 10) {
                            size = 'large';
                            className = 'marker-cluster-large';
                        } else if (count >= 5) {
                            size = 'medium';
                            className = 'marker-cluster-medium';
                        }
                        
                        return new L.DivIcon({
                            html: `<div><span>${count}</span></div>`,
                            className: `marker-cluster ${className}`,
                            iconSize: new L.Point(40, 40)
                        });
                    }
                });

                // Mejorar manejo de clicks en clusters
                cluster.on('clusterclick', function (a) {
                    if (map.getZoom() >= 11) {
                        a.layer.spiderfy();
                    } else {
                        map.fitBounds(a.layer.getBounds());
                    }
                });

                // CAMBIO PRINCIPAL: Crear un marcador por cada ubicación individual (sin agrupar por nombre)
                const todosLosMarkersIndividuales = [];
                
                geos.forEach((geo, index) => {
                    const lat = parseFloat(geo.latitud);
                    const lng = parseFloat(geo.longitud);
                    
                    if (isNaN(lat) || isNaN(lng)) {
                        console.warn('Coordenadas inválidas:', geo);
                        return;
                    }

                    // Crear icono personalizado con favicon de OE Chile
                    const customIcon = L.divIcon({
                        className: 'custom-marker-favicon',
                        html: '<img src="https://www.olimpiadasespecialeschile.net/favicon.png" alt="OE Chile">',
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    });

                    // Crear popup individual para cada ubicación específica
                    const marker = L.marker([lat, lng], {
                        icon: customIcon,
                        riseOnHover: true,
                        bubblingMouseEvents: false
                    }).bindPopup(`
                        <div class="popup-header">
                            <strong>${geo.nombre}</strong>
                            <span>Deporte: ${geo.deporte}</span>
                        </div>
                        <div class="popup-content">
                            ${geo.lugar ? `<strong>Lugar:</strong> ${geo.lugar}<br>` : ''}
                            ${geo.direccion && geo.direccion !== 'Por definir' ? `<strong>Dirección:</strong> ${geo.direccion}<br>` : ''}
                            <strong>Días del Taller:</strong> ${geo.dias_taller || 'S/I'}<br>
                            <strong>Horarios:</strong> ${geo.hora || 'S/I'}<br>
                            ${geo.edad ? `<strong>Edad:</strong> ${geo.edad}<br>` : ''}
                            ${geo.comuna ? `<strong>Comuna:</strong> ${geo.comuna}<br>` : ''}
                        ${geo.genero ? `<strong>Genero:</strong> ${geo.genero}<br>` : ''}
                            ${geo.email ? `<strong>Email:</strong> <a href="mailto:${geo.email}">${geo.email}</a><br>` : ''}
                            ${geo.telefono ? `<strong>Teléfono:</strong> <a href="tel:${geo.telefono}">${geo.telefono}</a><br>` : ''}
                            ${geo.web ? `<strong>Web:</strong> <a href="${geo.web}" target="_blank">${geo.web}</a><br>` : ''}
                            <button class="copy-button" onclick="copyToClipboard('${geo.direccion}', this)">
                                <i class="fas fa-copy"></i> Copiar Dirección
                            </button>
                        </div>
                    `, {
                        maxWidth: 300,
                        minWidth: 200,
                        closeButton: true,
                        autoClose: false,
                        closeOnClick: false,
                        autoPan: true,
                        autoPanPadding: [10, 10],
                        keepInView: true
                    });

                    // Evento para abrir popup - solo en desktop o cuando se fuerza desde el menú
                    marker.on('click', function(e) {
                        // En desktop siempre mostrar popup
                        if (window.innerWidth > 768) {
                            map.closePopup();
                            e.target.openPopup();
                            L.DomEvent.stopPropagation(e);
                        }
                        // En móvil, NO mostrar popup al hacer clic en marcadores
                    });

                    todosLosMarkers.push(marker);
                    todosLosMarkersIndividuales.push({marker, geo, index});
                    cluster.addLayer(marker);
                });

                map.addLayer(cluster);

                // Cerrar popup al hacer clic en el mapa (fuera de marcadores)
                map.on('click', function() {
                    map.closePopup();
                });

                // Crear estructura para sidebar manteniendo el formato original
                window.asociaciones = {};
                
                todosLosMarkersIndividuales.forEach(({marker, geo, index}) => {
                    const deporte = geo.deporte;
                    
                    if (!window.asociaciones[deporte]) {
                        window.asociaciones[deporte] = [];
                    }
                    
                    // Agregar cada ubicación individual con referencia única
                    window.asociaciones[deporte].push({
                        marker: marker,
                        nombre: geo.nombre,
                        data: geo
                    });
                });

                renderSidebar();
                updateStats();
                hideLoadingSpinner();

            } catch (error) {
                console.error('Error al cargar los datos:', error);
                hideLoadingSpinner();
                
                document.getElementById('asociacionesList').innerHTML = `
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        Error al cargar los datos: ${error.message}
                    </div>
                `;
            }
        }

        function renderSidebar() {
            const ul = document.getElementById('asociacionesList');
            ul.innerHTML = '';

            const regionOrden = {
                "Arica y Parinacota": 1,
                "Tarapacá": 2,
                "Antofagasta": 3,
                "Atacama": 4,
                "Coquimbo": 5,
                "Valparaíso": 6,
                "Metropolitana de Santiago": 7,
                "Libertador General Bernardo O'Higgins": 8,
                "Maule": 9,
                "Ñuble": 10,
                "Biobío": 11,
                "La Araucanía": 12,
                "Los Lagos": 13,
                "Aysén del General Carlos Ibáñez del Campo": 14,
                "Magallanes y de la Antártica Chilena": 15,
                "Los Ríos": 16
            };

            const regionRomano = {
                1: "XV", 
                2: "I", 
                3: "II", 
                4: "III", 
                5: "IV", 
                6: "V", 
                7: "RM", 
                8: "VI", 
                9: "VII",
                10: "XVI", 
                11: "VIII", 
                12: "IX", 
                13: "XIV", 
                14: "X", 
                15: "XI", 
                16: "XII"
            };

            // Organizar por región → deporte → nombre (mantener formato original)
            const regionesData = {};
            
            Object.keys(asociaciones).forEach(deporte => {
                asociaciones[deporte].forEach(({ marker, nombre, data }) => {
                    const region = data.region;
                    
                    if (!regionesData[region]) {
                        regionesData[region] = {};
                    }
                    
                    if (!regionesData[region][deporte]) {
                        regionesData[region][deporte] = {};
                    }
                    
                    // Crear clave única para cada ubicación individual
                    const claveUnica = `${nombre}_${data.latitud}_${data.longitud}`;
                    if (!regionesData[region][deporte][claveUnica]) {
                        regionesData[region][deporte][claveUnica] = {
                            marker: marker,
                            data: data
                        };
                    }
                });
            });

            Object.keys(regionesData)
                .sort((a, b) => (regionOrden[a] || 999) - (regionOrden[b] || 999))
                .forEach(region => {
                    const deportes = regionesData[region];
                    const numeroRegion = regionOrden[region];
                    const numeroRomano = numeroRegion ? regionRomano[numeroRegion] : "";
                    
                    // Contar total de talleres en la región
                    const totalTalleres = Object.values(deportes).reduce((sum, talleresPorDeporte) => 
                        sum + Object.keys(talleresPorDeporte).length, 0);
                    
                    const header = document.createElement('li');
                    header.className = 'region-header';
                    header.innerHTML = `
                        <span>
                            <i class="fas fa-map-marker-alt" style="margin-right: 8px; color: var(--primary-color);"></i>
                            ${numeroRomano ? numeroRomano + ' - ' : ''}${region} (${totalTalleres})
                        </span>
                        <span class="arrow">&#x25BC;</span>
                    `;

                    const regionContainer = document.createElement('div');
                    regionContainer.className = 'region-container';
                    regionContainer.style.display = 'none';

                    // Crear sub-secciones por deporte
                    Object.keys(deportes)
                        .sort()
                        .forEach(deporte => {
                            const talleresPorDeporte = deportes[deporte];
                            const cantidadTalleres = Object.keys(talleresPorDeporte).length;
                            
                            const deporteHeader = document.createElement('div');
                            deporteHeader.className = 'institucion-header';
                            deporteHeader.innerHTML = `
                                <span>
                                    <span style="color: ${getColorByDeporte(deporte)}; margin-right: 8px;">●</span>
                                    ${deporte} (${cantidadTalleres})
                                </span>
                                <span class="arrow-small">&#x25BC;</span>
                            `;

                            const talleresList = document.createElement('div');
                            talleresList.className = 'talleres-list';
                            talleresList.style.display = 'none';

                            // Crear lista de talleres para este deporte
                            const talleresContainer = document.createElement('ul');
                            talleresContainer.className = 'geo-list';
                            talleresContainer.style.display = 'block';

                            Object.keys(talleresPorDeporte)
                                .sort()
                                .forEach(claveUnica => {
                                    const { marker, data } = talleresPorDeporte[claveUnica];
                                    
                                    const listItem = document.createElement('li');
                                    const link = document.createElement('a');
                                    link.href = '#';
                                    // Mostrar información distintiva para cada ubicación individual
                                    const textoUbicacion = data.comuna && data.comuna !== data.nombre 
                                        ? `${data.nombre} - ${data.comuna}`
                                        : data.nombre;
                                    link.textContent = textoUbicacion;
                                    link.addEventListener('click', (e) => {
                                        e.preventDefault();
                                        
                                        // Limpiar selecciones anteriores
                                        document.querySelectorAll('.geo-list a').forEach(a => a.classList.remove('seleccionado'));
                                        
                                        // Marcar como seleccionado
                                        link.classList.add('seleccionado');
                                        
                                        // Hacer zoom al taller y abrir popup
                                        map.closePopup(); // Cerrar cualquier popup abierto
                                        map.setView(marker.getLatLng(), 15);
                                        
                                        // Forzar apertura de popup, especialmente en móviles
                                        if (window.innerWidth <= 768) {
                                            // En móvil, forzar apertura con más tiempo y múltiples intentos
                                            setTimeout(() => {
                                                marker.openPopup();
                                                // Segundo intento por si el primero falla
                                                setTimeout(() => {
                                                    if (!map.hasPopup || !map.hasPopup()) {
                                                        marker.openPopup();
                                                    }
                                                }, 100);
                                            }, 300);
                                        } else {
                                            // En desktop, apertura normal
                                            setTimeout(() => {
                                                marker.openPopup();
                                            }, 200);
                                        }
                                        
                                        // Cerrar menú móvil al hacer clic en taller específico (después del popup)
                                        if (window.innerWidth <= 768) {
                                            setTimeout(() => {
                                                closeMobileMenu();
                                            }, 500); // Esperar a que se abra el popup antes de cerrar menú
                                        }
                                    });
                                    
                                    listItem.appendChild(link);
                                    talleresContainer.appendChild(listItem);
                                });

                            talleresList.appendChild(talleresContainer);

                            // Event listener para expandir/contraer deporte
                            deporteHeader.onclick = () => {
                                // Mejorar detección del estado: considerar tanto display como clase expanded
                                const isCollapsed = talleresList.style.display === 'none' || 
                                                  talleresList.style.display === '' || 
                                                  !deporteHeader.classList.contains('expanded');
                                
                                // Primero cerrar todas las otras listas de deportes
                                document.querySelectorAll('.talleres-list').forEach(otherList => {
                                    if (otherList !== talleresList) {
                                        otherList.style.display = 'none';
                                    }
                                });
                                document.querySelectorAll('.institucion-header').forEach(otherHeader => {
                                    if (otherHeader !== deporteHeader) {
                                        otherHeader.classList.remove('expanded');
                                    }
                                });
                                
                                if (isCollapsed) {
                                    // Forzar apertura
                                    talleresList.style.display = 'block';
                                    deporteHeader.classList.add('expanded');
                                    
                                    // Cerrar cualquier popup abierto primero
                                    map.closePopup();
                                    
                                    // Fit bounds si hay múltiples talleres
                                    const markers = Object.values(talleresPorDeporte).map(t => t.marker);
                                    if (markers.length > 1) {
                                        const group = new L.featureGroup(markers);
                                        map.fitBounds(group.getBounds().pad(0.1));
                                    } else if (markers.length === 1) {
                                        map.setView(markers[0].getLatLng(), 12);
                                    }
                                    
                                    // No abrir popup automáticamente en móviles al seleccionar deporte
                                    
                                    // No cerrar menú al hacer clic en deporte, se cierra al hacer clic en taller específico
                                } else {
                                    // Forzar cierre
                                    talleresList.style.display = 'none';
                                    deporteHeader.classList.remove('expanded');
                                    // Cerrar popup cuando se cierra el deporte
                                    map.closePopup();
                                }
                            };

                            regionContainer.appendChild(deporteHeader);
                            regionContainer.appendChild(talleresList);
                        });

                    header.onclick = () => {
                        document.querySelectorAll('.region-header').forEach(el => el.classList.remove('seleccionado'));
                        document.querySelectorAll('.region-container').forEach(el => el.style.display = 'none');
                        document.querySelectorAll('.talleres-list').forEach(el => el.style.display = 'none');
                        
                        const isCollapsed = header.classList.contains('collapsed');
                        header.classList.toggle('collapsed');
                        
                        if (!isCollapsed) {
                            header.classList.add('seleccionado');
                            regionContainer.style.display = 'block';
                            
                            // Solo navegar en desktop (pantallas grandes)
                            if (window.innerWidth > 768) {
                                // Usar coordenadas precisas de Google Maps para centrar la región
                                const coords = getRegionCoordinates(region);
                                map.setView(coords, 8);
                                
                                // Fit bounds to show all markers of this region
                                const allMarkers = [];
                                Object.values(deportes).forEach(talleresPorDeporte => {
                                    Object.values(talleresPorDeporte).forEach(tallerData => {
                                        allMarkers.push(tallerData.marker);
                                    });
                                });
                                
                                if (allMarkers.length > 0) {
                                    const group = new L.featureGroup(allMarkers);
                                    map.fitBounds(group.getBounds().pad(0.1));
                                }
                            }
                        } else {
                            if (window.innerWidth > 768) {
                                goHome();
                            }
                        }
                        
                        // NO cerrar menú móvil para regiones - solo mostrar deportes
                    };

                    ul.appendChild(header);
                    ul.appendChild(regionContainer);
                });
        }

        function getColorByDeporte(deporte) {
            const colores = {
                'Atletismo': '#FF6B35',
                'Natación': '#4A90E2',
                'Básquetbol': '#FF8C00',
                'Fútbol': '#32CD32',
                'Tenis': '#FFD700',
                'Voleibol': '#9370DB',
                'Gimnasia': '#FF1493',
                'Ciclismo': '#00CED1',
                'Bowling': '#DC143C',
                'Equitación': '#8B4513'
            };
            return colores[deporte] || '#007BFF';
        }

        function updateStats() {
            const totalTalleres = todosLosMarkers.length;
            const totalDeportes = Object.keys(window.asociaciones).length;
            
            document.getElementById('total-talleres').textContent = totalTalleres;
            document.getElementById('total-deportes').textContent = totalDeportes;
        }

        // Función para alternar tema
        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        }

        // Función para actualizar icono de tema
        function updateThemeIcon(theme) {
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                const icon = themeToggle.querySelector('i');
                if (theme === 'dark') {
                    icon.className = 'fas fa-sun';
                } else {
                    icon.className = 'fas fa-moon';
                }
            }
        }

        // Función para centrar en Chile
        function centerOnChile() {
            if (map) {
                map.setView([-33.45, -70.6667], 5);
            }
        }

        // Función para pantalla completa
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        // Funciones para el menú móvil
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const menuToggle = document.querySelector('.mobile-menu-toggle');
            
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            
            // Cambiar icono del botón
            const icon = menuToggle.querySelector('i');
            if (sidebar.classList.contains('open')) {
                icon.className = 'fas fa-times';
            } else {
                icon.className = 'fas fa-bars';
            }
        }

        function closeMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const menuToggle = document.querySelector('.mobile-menu-toggle');
            
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            
            // Restaurar icono del botón
            const icon = menuToggle.querySelector('i');
            icon.className = 'fas fa-bars';
        }



        // Inicialización del tema
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            updateThemeIcon(savedTheme);
            
            initMap();
        });
    </script>
    
    <!-- Mensaje de confirmación -->
    <div style="position: fixed; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.8); color: white; padding: 12px; text-align: center; font-size: 12px; z-index: 1001;">
        <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
        La ubicación y la disponibilidad deben confirmarse con el Programa Local
    </div>
</body>
</html>