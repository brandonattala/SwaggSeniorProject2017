namespace Swagg.Api.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class Promotion_Facebook : DbMigration
    {
        public override void Up()
        {
            AddColumn("dbo.Promotions", "FacebookPost", c => c.Boolean(nullable: false));
            AddColumn("dbo.Promotions", "FacebookPostId", c => c.String());
            AddColumn("dbo.Promotions", "FacebookAccessToken", c => c.String());
            AddColumn("dbo.Promotions", "HangfireJobId", c => c.String());
        }
        
        public override void Down()
        {
            DropColumn("dbo.Promotions", "HangfireJobId");
            DropColumn("dbo.Promotions", "FacebookAccessToken");
            DropColumn("dbo.Promotions", "FacebookPostId");
            DropColumn("dbo.Promotions", "FacebookPost");
        }
    }
}
