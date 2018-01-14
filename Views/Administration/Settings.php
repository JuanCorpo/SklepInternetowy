<?php

function Settings()
{
    echo "
    <div style='display:inline;'>
            <h2 style='display:inline;'>Ustawienia</h2>
        </div>
        <hr>
        
    Edycja elementów stopki
    <table class=\"table table-hover\">
  <thead>
    <tr>
      <th scope=\"col\">Type</th>
      <th scope=\"col\">Column heading</th>
      <th scope=\"col\">Column heading</th>
      <th scope=\"col\">Column heading</th>
    </tr>
  </thead>
  
  <tbody>
    <tr class=\"table-active\">
      <th scope=\"row\">Active</th>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
    </tr>
    <tr>
      <th scope=\"row\">Default</th>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
    </tr>
  </tbody>
</table>
    ";
}