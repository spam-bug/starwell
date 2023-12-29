<x-guest-layout>
    <div class="w-full max-w-7xl mx-auto py-8 masonry-container">
        @for($index = 1; $index <= 15; $index++)
            <div class="masonry-item">
                <img src="{{ Vite::image("gallery/$index.jpg") }}" alt="">
            </div>
        @endfor
    </div>

    <script>
        // Calculate aspect ratio and set the number of columns based on the screen width
        function calculateColumns() {
            const container = document.getElementById('masonry-container');
            const items = container.getElementsByClassName('masonry-item');

            let columns = 4; // Default for large screens

            if (window.innerWidth < 1024) {
                columns = 3; // Set to 3 columns for tablets
            }

            const columnWidth = (container.offsetWidth - (columns - 1) * 20) / columns;

            for (let i = 0; i < items.length; i++) {
                const img = items[i].getElementsByTagName('img')[0];
                const aspectRatio = img.width / img.height;

                items[i].style.flex = `${aspectRatio} 1 0%`;
                items[i].style.width = `${columnWidth}px`;
            }
        }

        // Recalculate columns on window resize
        window.addEventListener('resize', calculateColumns);

        // Initial calculation
        calculateColumns();
    </script>
</x-guest-layout>
