namespace Swagg.Api.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class Add_FileUpload_Table : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.FileUploads",
                c => new
                    {
                        FileUploadId = c.Int(nullable: false, identity: true),
                        FileName = c.String(),
                        FileData = c.String(),
                        PromotionId = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.FileUploadId)
                .ForeignKey("dbo.Promotions", t => t.PromotionId, cascadeDelete: true)
                .Index(t => t.PromotionId);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.FileUploads", "PromotionId", "dbo.Promotions");
            DropIndex("dbo.FileUploads", new[] { "PromotionId" });
            DropTable("dbo.FileUploads");
        }
    }
}
