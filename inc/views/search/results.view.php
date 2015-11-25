<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
            <h2>Search results</h2>        
                {if:results}
                    {foreach:results}
                        <p>
                            <a style='font-weight:bold' href='/en/{{loop_element:where}}/{{loop_element:id}}'>
                                {{loop_element:title}}
                            </a>
                        </p>
                    {endforeach}
                {elseif}
                    No results found.
                {endif}
        </div>
    <div class='fill'>
    </div>
</div>