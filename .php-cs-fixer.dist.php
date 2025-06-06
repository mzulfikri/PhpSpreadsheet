<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['vendor', 'docs', '.git', '.github'])
    ->notPath('src/PhpSpreadsheet/Writer/ZipStream3.php')
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect(null, 600))
    ->setCacheFile(sys_get_temp_dir() . '/php-cs-fixer' . preg_replace('~\W~', '-', __DIR__))
    ->setRules([
        'align_multiline_comment' => true,
        'array_indentation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'backtick_to_shell_exec' => true,
        'binary_operator_spaces' => true,
        'blank_line_after_namespace' => true,
        'blank_lines_before_namespace' => ['max_line_breaks' => 2, 'min_line_breaks' => 2], // we want 1 blank line before namespace
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => true,
        'cast_spaces' => true,
        'class_attributes_separation' => ['elements' => ['method' => 'one', 'property' => 'one']], // const are often grouped with other related const
        'class_definition' => false, // phpcs disagree
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'combine_nested_dirname' => true,
        'comment_to_phpdoc' => false, // interferes with annotations
        'compact_nullable_type_declaration' => true,
        'concat_space' => ['spacing' => 'one'],
        'constant_case' => true,
        'date_time_immutable' => false, // Break our unit tests
        'declare_equal_normalize' => true,
        'declare_strict_types' => false, // Too early to adopt strict types
        'dir_constant' => true,
        'doctrine_annotation_array_assignment' => true,
        'doctrine_annotation_braces' => true,
        'doctrine_annotation_indentation' => true,
        'doctrine_annotation_spaces' => true,
        'elseif' => true,
        'empty_loop_body' => true,
        'empty_loop_condition' => true,
        'encoding' => true,
        'ereg_to_preg' => true,
        'error_suppression' => false, // it breaks \PhpOffice\PhpSpreadsheet\Helper\Handler
        'explicit_indirect_variable' => false, // I feel it makes the code actually harder to read
        'explicit_string_variable' => false, // I feel it makes the code actually harder to read
        'final_class' => false, // We need non-final classes
        'final_internal_class' => true,
        'final_public_method_for_abstract_class' => false, // We need non-final methods
        'fopen_flag_order' => true,
        'fopen_flags' => true,
        'full_opening_tag' => true,
        'fully_qualified_strict_types' => true,
        'function_declaration' => true,
        'function_to_constant' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['access', 'category', 'copyright']],
        'general_phpdoc_tag_rename' => true,
        'global_namespace_import' => true,
        'group_import' => false, // I feel it makes the code actually harder to read
        'header_comment' => false, // We don't use common header in all our files
        'heredoc_indentation' => true,
        'heredoc_to_nowdoc' => false, // Not sure about this one
        'implode_call' => true,
        'include' => true,
        'increment_style' => true,
        'indentation_type' => true,
        'integer_literal_case' => true,
        'is_null' => true,
        'lambda_not_used_import' => true,
        'line_ending' => true,
        'linebreak_after_opening_tag' => true,
        'list_syntax' => ['syntax' => 'short'],
        'logical_operators' => true,
        'lowercase_cast' => true,
        'lowercase_keywords' => true,
        'lowercase_static_reference' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'mb_str_functions' => false, // No, too dangerous to change that
        'method_argument_space' => true,
        'method_chaining_indentation' => true,
        'modernize_strpos' => true,
        'modernize_types_casting' => true,
        'multiline_comment_opening_closing' => true,
        'multiline_whitespace_before_semicolons' => true,
        'native_constant_invocation' => false, // Micro optimization that look messy
        'native_function_casing' => true,
        'native_function_invocation' => false, // I suppose this would be best, but I am still unconvinced about the visual aspect of it
        'new_with_parentheses' => ['anonymous_class' => true, 'named_class' => true],
        'no_alias_functions' => true,
        'no_alias_language_construct_call' => true,
        'no_alternative_syntax' => true,
        'no_binary_string' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_break_comment' => true,
        'no_closing_tag' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => true,
        'no_homoglyph_names' => true,
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_null_property_initialization' => true,
        'no_php4_constructor' => true,
        'no_short_bool_cast' => true,
        'echo_tag_syntax' => ['format' => 'long'],
        'no_singleline_whitespace_before_semicolons' => true,
        'no_space_around_double_colon' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_around_offset' => true,
        'no_superfluous_elseif' => false, // Might be risky on a huge code base
        'no_superfluous_phpdoc_tags' => ['allow_mixed' => true],
        'no_trailing_comma_in_singleline' => ['elements' => ['arguments', 'array_destructuring', 'array', 'group_import']],
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_trailing_whitespace_in_string' => false, // Too dangerous
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_braces' => true,
        'no_unneeded_final_method' => true,
        'no_unreachable_default_argument_value' => true,
        'no_unset_cast' => true,
        'no_unset_on_property' => false,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_useless_sprintf' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'non_printable_character' => true,
        'normalize_index_brace' => true,
        'not_operator_with_space' => false, // No we prefer to keep '!' without spaces
        'not_operator_with_successor_space' => false, // idem
        'nullable_type_declaration_for_default_null_value' => true,
        'object_operator_without_whitespace' => true,
        'octal_notation' => true,
        'operator_linebreak' => true,
        'ordered_class_elements' => false, // We prefer to keep some freedom
        'ordered_imports' => true,
        'ordered_interfaces' => true,
        'ordered_traits' => true,
        'php_unit_attributes' => ['keep_annotations' => false],
        'php_unit_construct' => true,
        'php_unit_dedicate_assert' => true,
        'php_unit_dedicate_assert_internal_type' => true,
        'php_unit_expectation' => true,
        'php_unit_fqcn_annotation' => true,
        'php_unit_internal_class' => false, // Because tests are excluded from package
        'php_unit_method_casing' => true,
        'php_unit_mock' => true,
        'php_unit_mock_short_will_return' => true,
        'php_unit_namespaced' => true,
        'php_unit_no_expectation_annotation' => true,
        'phpdoc_order_by_value' => ['annotations' => ['covers']],
        'php_unit_set_up_tear_down_visibility' => true,
        'php_unit_size_class' => false, // That seems extra work to maintain for little benefits
        'php_unit_strict' => false, // We sometime actually need assertEquals
        'php_unit_test_annotation' => true,
        'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
        'php_unit_test_class_requires_covers' => false, // We don't care as much as we should about coverage
        'phpdoc_add_missing_param_annotation' => false, // Don't add things that bring no value
        'phpdoc_align' => false, // Waste of time
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_indent' => true,
        'phpdoc_line_span' => false, // Unfortunately our old comments turn even uglier with this
        'phpdoc_no_access' => true,
        'phpdoc_no_alias_tag' => true,
        'phpdoc_no_empty_return' => true,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_order' => true,
        'phpdoc_return_self_reference' => true,
        'phpdoc_scalar' => true,
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_tag_casing' => true,
        'phpdoc_tag_type' => true,
        'phpdoc_to_comment' => false, // interferes with annotations
        'phpdoc_to_param_type' => false, // Because experimental, but interesting for one shot use
        'phpdoc_to_property_type' => false, // Because experimental, but interesting for one shot use
        'phpdoc_to_return_type' => false, // Because experimental, but interesting for one shot use
        'phpdoc_trim' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_types' => true,
        'phpdoc_types_order' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'phpdoc_var_without_name' => true,
        'pow_to_exponentiation' => true,
        'protected_to_private' => true,
        'psr_autoloading' => true,
        'random_api_migration' => true,
        'return_assignment' => false, // Sometimes useful for clarity or debug
        'return_type_declaration' => true,
        'self_accessor' => true,
        'self_static_accessor' => true,
        'semicolon_after_instruction' => false, // Buggy in `samples/index.php`
        'set_type_to_cast' => true,
        'short_scalar_cast' => true,
        'simple_to_complex_string_variable' => false, // Would differ from TypeScript without obvious advantages
        'simplified_if_return' => false, // Even if technically correct we prefer to be explicit
        'simplified_null_return' => false, // Even if technically correct we prefer to be explicit
        'single_blank_line_at_eof' => true,
        'single_class_element_per_statement' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'single_line_comment_style' => true,
        'single_line_throw' => false, // I don't see any reason for having a special case for Exception
        'single_quote' => true,
        'single_trait_insert_per_statement' => true,
        'space_after_semicolon' => true,
        'spaces_inside_parentheses' => ['space' => 'none'],
        'standardize_increment' => true,
        'standardize_not_equals' => true,
        'static_lambda' => false, // Risky if we can't guarantee nobody use `bindTo()`
        'strict_comparison' => false, // No, too dangerous to change that
        'string_implicit_backslashes' => ['single_quoted' => 'unescape', 'double_quoted' => 'escape', 'heredoc' => 'escape'], // was escape_implicit_backslashes
        'strict_param' => false, // No, too dangerous to change that
        'string_length_to_empty' => true,
        'string_line_ending' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'switch_continue_to_break' => true,
        'ternary_operator_spaces' => true,
        'ternary_to_elvis_operator' => true,
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline' => true,
        'trim_array_spaces' => true,
        'type_declaration_spaces' => ['elements' => ['function', 'property']], // was function_typehint_space
        'types_spaces' => true,
        'unary_operator_spaces' => true,
        'use_arrow_functions' => true,
        'visibility_required' => ['elements' => ['property', 'method']], // not const
        'void_return' => true,
        'whitespace_after_comma_in_array' => true,
        'yoda_style' => false,
    ]);

return $config;
