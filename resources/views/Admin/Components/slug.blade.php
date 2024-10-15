<script>
    const title = document.querySelector('.titleSlug');
    const slug = document.querySelector('.slug');
    const db = '{{ $db }}';
    console.log(db);


    title.addEventListener('change', function() {
        fetch('/dashboard/slug/slugMaker?title=' + title.value + '&db=' + db)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script>
