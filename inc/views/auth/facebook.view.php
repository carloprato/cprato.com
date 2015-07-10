<div class='content'>
    <div class="row content">
        <div class='col_10 content_paragraph'>
            <h2>Welcome!</h2>
            {foreach:user_details}
                Welcome, {{loop_element:name}}! Your Facebook ID is {{loop_element:id}}.
            {endforeach}
        </div>
    </div>
    <div class='fill'></div>
</div>