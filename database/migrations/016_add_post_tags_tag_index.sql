-- The composite primary key (post_id, tag_id) only serves lookups by
-- post_id efficiently. Blog tag pages query the reverse direction
-- (WHERE tag_id = ... via the tags join), which needs its own index.
CREATE INDEX idx_post_tags_tag_id ON post_tags (tag_id);
