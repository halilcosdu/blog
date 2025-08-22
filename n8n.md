<n8n-guidelines>

# n8n Guidelines

Use n8n-MCP tools to design **accurate** and **efficient** workflows. Principles: **validate early**, **minimize custom code**, **validate often**.

## Core Workflow Process

1. **At the start of every new conversation**: call `tools_documentation()` to learn available tools and best practices.
2. **Discovery**:
    - Clarify the need; ask brief follow-ups if something is unclear.
    - Use `search_nodes({query})`, `list_nodes({category:'trigger'})`, `list_ai_tools()`.
3. **Configuration**:
    - Start with `get_node_essentials(nodeType)` (10–20 key props).
    - Use `search_node_properties(nodeType, 'auth')`, `get_node_for_task('send_email')`, `get_node_documentation(nodeType)`.
    - It’s good practice to show a **visual architecture** of the workflow and get user feedback before building.
4. **Pre-Validation**:
    - `validate_node_minimal(nodeType, config)`
    - `validate_node_operation(nodeType, config, profile)`
    - Fix errors **before** proceeding.
5. **Building**:
    - Assemble nodes with validated configs.
    - Add error handling.
    - Use expressions like `$json`, `$node["NodeName"].json`.
    - Produce the workflow as an **artifact** unless the user asked to create it in a live n8n instance.
6. **Workflow Validation**:
    - `validate_workflow(workflow)`
    - `validate_workflow_connections(workflow)`
    - `validate_workflow_expressions(workflow)`
    - Fix all issues.
7. **Deployment** (when n8n API is configured):
    - `n8n_create_workflow(workflow)`
    - `n8n_validate_workflow({id})`
    - `n8n_update_partial_workflow()` (diff-based)
    - `n8n_trigger_webhook_workflow()`

## Key Insights

- **Use the Code node only when necessary**; prefer standard nodes first.
- **Validate early and often**.
- **Use diff updates** for 80–90% token savings.
- **Any node can be an AI tool** (not only those flagged as usableAsTool).
- Always pre-validate configurations and post-validate the full workflow.

## Validation Strategy

**Before building**
1. `validate_node_minimal`
2. `validate_node_operation`

**After building**
1. `validate_workflow`
2. `validate_workflow_connections`
3. `validate_workflow_expressions`

**After deployment**
1. `n8n_validate_workflow({id})`
2. `n8n_list_executions()`
3. `n8n_update_partial_workflow()` (diffs)

## Response Structure

1. Discovery
2. Pre-Validation
3. Configuration (show only **validated**, working configs)
4. Building
5. Workflow Validation
6. Deployment
7. Post-Validation

## Example (Summary)

- `search_nodes({query:'slack'})`
- `get_node_essentials('n8n-nodes-base.slack')`
- `validate_node_minimal('n8n-nodes-base.slack', {resource:'message', operation:'send'})`
- `validate_node_operation('n8n-nodes-base.slack', fullConfig, 'runtime')`
- Build workflow JSON → run `validate_*` → (if configured) `n8n_create_workflow` + `n8n_validate_workflow`.

## Important Rules

- **Validate before and after** building.
- **Never** deploy an unvalidated workflow.
- Use **diff** operations for updates.
- Report validation results clearly and **fix** errors.

</n8n-guidelines>
