namespace Swagg.Api.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class Add_Promotion_Table : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Promotions",
                c => new
                    {
                        PromotionId = c.Int(nullable: false, identity: true),
                        Title = c.String(),
                        Description = c.String(),
                        UserId = c.Int(nullable: false),
                        Start = c.DateTime(nullable: false),
                        End = c.DateTime(nullable: false),
                        Category = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.PromotionId);
            
        }
        
        public override void Down()
        {
            DropTable("dbo.Promotions");
        }
    }
}
