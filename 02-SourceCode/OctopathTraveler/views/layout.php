<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Octopath Traveler - Character Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'octopath-gold': '#D4AF37',
                        'octopath-dark': '#1a1a2e',
                        'octopath-blue': '#16213e',
                        'octopath-purple': '#8b5cf6',
                    }
                }
            }
        }
    </script>
    <style>
        .bg-gradient-octopath {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .ability-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-octopath min-h-screen text-white">
    <nav class="bg-black bg-opacity-50 backdrop-blur-md border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-octopath-gold">Octopath Traveler</h1>
                    <span class="ml-2 text-sm text-gray-400">Character Manager</span>
                </div>
                <div class="flex space-x-4">
                    <a href="index.php?page=home" class="text-gray-300 hover:text-octopath-gold px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Characters
                    </a>
                    <a href="index.php?page=abilities" class="text-gray-300 hover:text-octopath-gold px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        All Abilities
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php
        $viewFile = "views/$view.php";
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            echo "<div class='text-center py-20'>";
            echo "<h2 class='text-2xl font-bold text-red-400'>View not found: $view</h2>";
            echo "</div>";
        }
        ?>
    </main>

    <footer class="bg-black bg-opacity-50 backdrop-blur-md border-t border-gray-700 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-gray-400">
                <p>&copy; 2025 Octopath Traveler Character Manager. Built with PHP & Tailwind CSS.</p>
            </div>
        </div>
    </footer>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
            
            // Add click effects to buttons
            document.querySelectorAll('button, .btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    let ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>
</body>
</html>
