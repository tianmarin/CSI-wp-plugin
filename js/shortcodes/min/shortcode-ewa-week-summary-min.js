jQuery(document).ready(function($){$('[data-toggle="tooltip"]').tooltip(),$(".ewa-week-summary-sql-code-button").click(function(){var t=$(this).data("system-no");$.alert("SELECT * from "+t)})});