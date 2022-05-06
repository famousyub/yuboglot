var keywords = ['ABSOLUTE', 'ACTION', 'ADD', 'AGGR', 'ALL', 'ALTER', 'AND', 'ANTI', 'ANY', 'APPLY', 'ARRAY', 'AS', 'ASSERT', 'ASC', 'ATTACH', 'AUTOINCREMENT', 'AUTO_INCREMENT', 'AVG', 'BEGIN', 'BETWEEN', 'BREAK', 'BY', 'CALL', 'CASE', 'CAST', 'CHECK', 'CLASS', 'CLOSE', 'COLLATE', 'COLUMN', 'COLUMNS', 'COMMIT', 'CONSTRAINT', 'CONTENT', 'CONTINUE', 'CONVERT', 'CORRESPONDING', 'COUNT', 'CREATE', 'CROSS', 'CUBE', 'CURRENT_TIMESTAMP', 'CURSOR', 'DATABASE', 'DECLARE', 'DEFAULT', 'DELETE', 'DELETED', 'DESC', 'DETACH', 'DISTINCT', 'DOUBLEPRECISION', 'DROP', 'ECHO', 'EDGE', 'END', 'ENUM', 'ELSE', 'EXCEPT', 'EXISTS', 'EXPLAIN', 'FALSE', 'FETCH', 'FIRST', 'FOREIGN', 'FROM', 'GO', 'GRAPH', 'GROUP', 'GROUPING', 'HAVING', 'HELP', 'IF', 'IDENTITY', 'IS', 'IN', 'INDEX', 'INNER', 'INSERT', 'INSERTED', 'INTERSECT', 'INTO', 'JOIN', 'KEY', 'LAST', 'LET', 'LEFT', 'LIKE', 'LIMIT', 'LOOP', 'MATCHED', 'MATRIX', 'MAX', 'MERGE', 'MIN', 'MINUS', 'MODIFY', 'NATURAL', 'NEXT', 'NEW', 'NOCASE', 'NO', 'NOT', 'NULL', 'OFF', 'ON', 'ONLY', 'OFFSET', 'OPEN', 'OPTION', 'OR', 'ORDER', 'OUTER', 'OVER', 'PATH', 'PARTITION', 'PERCENT', 'PLAN', 'PRIMARY', 'PRINT', 'PRIOR', 'QUERY', 'READ', 'RECORDSET', 'REDUCE', 'REFERENCES', 'RELATIVE', 'REPLACE', 'REMOVE', 'RENAME', 'REQUIRE', 'RESTORE', 'RETURN', 'RETURNS', 'RIGHT', 'ROLLBACK', 'ROLLUP', 'ROW', 'SCHEMA(S)?', 'SEARCH', 'SELECT', 'SEMI', 'SET', 'SETS', 'SHOW', 'SOME', 'SOURCE', 'STRATEGY', 'STORE', 'SUM', 'TABLE', 'TABLES', 'TARGET', 'TEMP', 'TEMPORARY', 'TEXTSTRING', 'THEN', 'TIMEOUT', 'TO', 'TOP', 'TRAN', 'TRANSACTION', 'TRIGGER', 'TRUE', 'TRUNCATE', 'UNION', 'UNIQUE', 'UPDATE', 'USE', 'USING', 'VALUE', 'VERTEX', 'VIEW', 'WHEN', 'WHERE', 'WHILE', 'WITH', 'WORK'];

var re = new RegExp('^(' + keywords.join('|') + ')$', 'i');
function alasql_formatter(string) {
    return string.split(/(\s+)/).map(function(string) {
        if (re.test(string)) {
            return '[[b;#fff;]' + string + ']';
        } else {
            return string;
        }
    }).join('');
}

$.terminal.defaults.formatters.push(alasql_formatter);

function query(command, term) {
    term.pause();
    alasql(command, [], function(result) {
        if (typeof result == 'number') {
            term.echo(result + ' row' + (result!=1?'s':'') + ' affected', {formatters: false});
        } else if (result.length > 0) {
            var keys = Object.keys(result[0]);
            result = [keys].concat(result.map(function(row) {
                if (row instanceof Array) {
                    return row.map(function(item) {
                        return $.terminal.escape_brackets(String(item));
                    });
                } else {
                    return Object.keys(row).map(function(key) {
                        return $.terminal.escape_brackets(String(row[key]));
                    });
                }
            }));
            term.echo(ascii_table(result, true), {formatters: false});
        }
        term.resume();
    });
}

alasql('CREATE INDEXEDDB DATABASE IF NOT EXISTS MyBase; \
        ATTACH INDEXEDDB DATABASE MyBase; \
        USE MyBase;', [], function() {
    var term = $('body').terminal(function(command, term) {
        if (!command.trim()) {
            return;
        }
        try {
            query(command, term);
        } catch(e) {
            term.error(e.message).resume();
        }
    }, {
        greetings: '[[!;;;;http://alasql.org]alaSQL] ' + alasql.version +
                   '; [[!;;;;http://terminal.jcubic.pl]jQuery Terminal] ' + $.terminal.version,
        name: 'sql',
        prompt: 'sql> ',
        completion: keywords,
        caseSensitiveAutocomplete: false
    });
});
